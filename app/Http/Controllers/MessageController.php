<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Store a new message in a thread.
     */
    public function store(Request $request, Thread $thread)
    {
        $this->authorize('view', $thread);

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
            'attachment' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        ]);

        $user = auth()->user();

        // Determine sender role
        $senderRole = 'user';
        if ($user->isAdmin()) {
            $senderRole = 'admin';
        } elseif ($user->isTeam()) {
            $senderRole = 'team';
        }

        // Handle file attachment if present
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message-attachments', 'private');
        }

        // Create message
        $message = Message::create([
            'thread_id' => $thread->id,
            'sender_id' => $user->id,
            'sender_role' => $senderRole,
            'message' => $validated['message'],
            'attachment_path' => $attachmentPath,
        ]);

        // Reopen thread if it was closed
        if ($thread->isClosed()) {
            $thread->reopen();
        }

        return back()->with('success', 'Message sent successfully!');
    }

    /**
     * Download message attachment.
     */
    public function downloadAttachment(Message $message)
    {
        $this->authorize('view', $message);

        if (!$message->attachment_path) {
            abort(404, 'No attachment found.');
        }

        if (!Storage::disk('private')->exists($message->attachment_path)) {
            abort(404, 'Attachment file not found.');
        }

        return Storage::disk('private')->download($message->attachment_path);
    }

    /**
     * Delete a message (admin only).
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        try {
            // Delete attachment if exists
            if ($message->attachment_path) {
                Storage::disk('private')->delete($message->attachment_path);
            }

            $message->delete();

            return back()->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete message: ' . $e->getMessage());
        }
    }
}

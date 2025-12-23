<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of documents.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $documents = Document::with(['user', 'uploader'])
                ->latest()
                ->paginate(15);
        } else {
            $documents = Document::with(['uploader'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(15);
        }

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $this->authorize('create', Document::class);
        
        if (auth()->user()->isAdmin()) {
            $users = \App\Models\User::where('role', 'user')->get();
            return view('documents.create', compact('users'));
        }
        
        return view('documents.create');
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Document::class);

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,xlsx,xls,csv,doc,docx|max:10240',
            'user_id' => auth()->user()->isAdmin() ? 'required|exists:users,id' : 'nullable',
            'description' => 'nullable|string|max:1000',
        ]);

        $file = $request->file('file');
        $userId = auth()->user()->isAdmin() && $request->user_id 
            ? $request->user_id 
            : auth()->id();

        // Store file in private storage
        $path = $file->store('documents/' . $userId, 'private');

        $document = Document::create([
            'user_id' => $userId,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'uploaded_by' => auth()->id(),
            'description' => $request->description,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified document.
     */
    public function show(Document $document)
    {
        $this->authorize('view', $document);
        
        return view('documents.show', compact('document'));
    }

    /**
     * Download the document.
     */
    public function download(Document $document)
    {
        $this->authorize('view', $document);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('private')->download(
            $document->file_path,
            $document->file_name
        );
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit(Document $document)
    {
        $this->authorize('update', $document);

        if (auth()->user()->isAdmin()) {
            $users = \App\Models\User::where('role', 'user')->get();
            return view('documents.edit', compact('document', 'users'));
        }

        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        $validated = $request->validate([
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,xlsx,xls,csv,doc,docx|max:10240',
            'user_id' => auth()->user()->isAdmin() ? 'nullable|exists:users,id' : 'nullable',
            'description' => 'nullable|string|max:1000',
        ]);

        // Update file if provided
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('private')->delete($document->file_path);

            $file = $request->file('file');
            $userId = $document->user_id;

            if (auth()->user()->isAdmin() && $request->user_id) {
                $userId = $request->user_id;
            }

            $path = $file->store('documents/' . $userId, 'private');

            $document->update([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'user_id' => $userId,
            ]);
        } elseif (auth()->user()->isAdmin() && $request->user_id) {
            $document->update(['user_id' => $request->user_id]);
        }

        if ($request->description !== null) {
            $document->update(['description' => $request->description]);
        }

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        // Delete file from storage
        Storage::disk('private')->delete($document->file_path);

        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}

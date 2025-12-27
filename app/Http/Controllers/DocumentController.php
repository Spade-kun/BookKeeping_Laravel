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
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Team members view documents of their assigned users
        if ($user->isTeam()) {
            $team = $user->primaryTeam();
            
            if (!$team) {
                return view('documents.team-index', [
                    'documents' => collect(),
                    'team' => null,
                    'users' => collect(),
                ]);
            }
            
            // Get all users assigned to this team
            $assignedUserIds = \App\Models\User::whereHas('thread', function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })->pluck('id');
            
            $year = $request->get('year');
            $type = $request->get('type');
            $userId = $request->get('user');
            $search = $request->get('search');
            
            $query = \App\Models\Document::with(['user', 'uploader'])
                ->whereIn('user_id', $assignedUserIds);
            
            // Filter by user
            if ($userId) {
                $query->where('user_id', $userId);
            }
            
            // Filter by year
            if ($year) {
                $query->where('year', $year);
            }
            
            // Filter by type
            if ($type) {
                $query->where('type', $type);
            }
            
            // Search
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('file_name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
            
            $documents = $query->latest()->paginate(15);
            
            // Get available years and types
            $availableYears = \App\Models\Document::whereIn('user_id', $assignedUserIds)
                ->distinct()
                ->pluck('year')
                ->sort()
                ->reverse();
            $years = $availableYears->isNotEmpty() ? $availableYears->values()->all() : [date('Y')];
            $types = ['Receipts', 'Invoices', 'Bank Statements', 'Payroll', 'Reports', 'Other'];
            
            // Get users with documents
            $users = \App\Models\User::whereIn('id', $assignedUserIds)
                ->whereHas('documents')
                ->get();
            
            return view('documents.team-index', compact('documents', 'team', 'users', 'years', 'types', 'year', 'type', 'userId'));
        }
        
        $year = $request->get('year');
        $type = $request->get('type');
        $search = $request->get('search');
        
        $query = Document::with(['user', 'uploader']);
        
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }
        
        // Filter by year
        if ($year) {
            $query->where('year', $year);
        }
        
        // Filter by type
        if ($type) {
            $query->where('type', $type);
        }
        
        // Search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('file_name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $documents = $query->latest()->paginate(15);
        
        // Get available years dynamically from database
        $availableYears = Document::query()
            ->when(!$user->isAdmin(), fn($q) => $q->where('user_id', $user->id))
            ->distinct()
            ->pluck('year')
            ->sort()
            ->reverse();
        $years = $availableYears->isNotEmpty() ? $availableYears->values()->all() : [date('Y')];
        $types = ['Receipts', 'Invoices', 'Bank Statements', 'Payroll', 'Reports', 'Other'];
        
        // Get folder structure (year > type grouping)
        $folders = Document::query()
            ->when(!$user->isAdmin(), fn($q) => $q->where('user_id', $user->id))
            ->selectRaw('year, type, COUNT(*) as count')
            ->groupBy('year', 'type')
            ->orderBy('year', 'desc')
            ->orderBy('type')
            ->get()
            ->groupBy('year');

        return view('documents.index', compact('documents', 'years', 'types', 'folders', 'year', 'type'));
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
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'type' => 'required|in:Receipts,Invoices,Bank Statements,Payroll,Reports,Other',
        ]);

        $file = $request->file('file');
        $userId = auth()->user()->isAdmin() && $request->user_id 
            ? $request->user_id 
            : auth()->id();

        // Store file in organized folder structure: documents/{userId}/{year}/{type}/
        $folderPath = "documents/{$userId}/{$request->year}/{$request->type}";
        $path = $file->store($folderPath, 'private');

        $document = Document::create([
            'user_id' => $userId,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'uploaded_by' => auth()->id(),
            'description' => $request->description,
            'year' => $request->year,
            'type' => $request->type,
        ]);

        // TODO: Log activity when ActivityLog model is created
        // \App\Models\ActivityLog::create([...]);

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

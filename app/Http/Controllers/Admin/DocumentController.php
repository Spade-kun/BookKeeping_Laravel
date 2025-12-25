<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display all documents organized by users
     */
    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $year = $request->get('year');
        $type = $request->get('type');
        $search = $request->get('search');
        
        $query = Document::with(['user', 'uploader']);
        
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
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }
        
        $documents = $query->latest()->paginate(20);
        
        // Get users for filtering
        $users = User::where('role', 'user')->orderBy('name')->get();
        
        // Get available years dynamically from database
        $availableYears = Document::distinct()->pluck('year')->sort()->reverse();
        $years = $availableYears->isNotEmpty() ? $availableYears->values()->all() : [date('Y')];
        $types = ['Receipts', 'Invoices', 'Bank Statements', 'Payroll', 'Reports', 'Other'];
        
        // Get folder structure grouped by user > year > type
        $userFolders = Document::with('user')
            ->selectRaw('user_id, year, type, COUNT(*) as count')
            ->groupBy('user_id', 'year', 'type')
            ->orderBy('user_id')
            ->orderBy('year', 'desc')
            ->orderBy('type')
            ->get()
            ->groupBy('user_id');

        return view('admin.documents.index', compact('documents', 'users', 'years', 'types', 'userFolders', 'userId', 'year', 'type'));
    }
}

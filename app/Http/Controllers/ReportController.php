<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReportController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of reports.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $reports = Report::with('user')
                ->latest()
                ->paginate(15);
        } else {
            $reports = Report::where('user_id', $user->id)
                ->latest()
                ->paginate(15);
        }

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $this->authorize('create', Report::class);
        
        $users = \App\Models\User::where('role', 'user')->get();
        return view('reports.create', compact('users'));
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Report::class);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'report_type' => 'required|in:monthly,quarterly,yearly,custom',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv|max:10240',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $data = $validated;

        // Store file if provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('reports/' . $request->user_id, 'private');
            $data['file_path'] = $path;
        }

        $report = Report::create($data);

        return redirect()->route('reports.index')
            ->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $this->authorize('view', $report);
        
        return view('reports.show', compact('report'));
    }

    /**
     * Download the report.
     */
    public function download(Report $report)
    {
        $this->authorize('view', $report);

        if (!$report->file_path || !Storage::disk('private')->exists($report->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('private')->download(
            $report->file_path,
            $report->title . '.pdf'
        );
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $this->authorize('update', $report);

        $users = \App\Models\User::where('role', 'user')->get();
        return view('reports.edit', compact('report', 'users'));
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'report_type' => 'required|in:monthly,quarterly,yearly,custom',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv|max:10240',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Update file if provided
        if ($request->hasFile('file')) {
            // Delete old file
            if ($report->file_path) {
                Storage::disk('private')->delete($report->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('reports/' . $request->user_id, 'private');
            $validated['file_path'] = $path;
        }

        $report->update($validated);

        return redirect()->route('reports.index')
            ->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);

        // Delete file from storage
        if ($report->file_path) {
            Storage::disk('private')->delete($report->file_path);
        }

        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }
}

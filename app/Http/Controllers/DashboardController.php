<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'documents' => Document::where('user_id', $user->id)->count(),
            'reports' => Report::where('user_id', $user->id)->count(),
            'nextReview' => $this->getNextReviewDate($user),
        ];
        
        return view('dashboard.user', compact('stats'));
    }
    
    private function getNextReviewDate($user)
    {
        // Get the latest report for the user
        $latestReport = Report::where('user_id', $user->id)
            ->orderBy('end_date', 'desc')
            ->first();
        
        if (!$latestReport) {
            return null;
        }
        
        // Calculate next review based on report type
        $endDate = \Carbon\Carbon::parse($latestReport->end_date);
        
        switch ($latestReport->report_type) {
            case 'monthly':
                return $endDate->addMonth();
            case 'quarterly':
                return $endDate->addMonths(3);
            case 'annual':
                return $endDate->addYear();
            default:
                return null;
        }
    }
}

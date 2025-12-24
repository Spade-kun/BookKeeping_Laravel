<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'title' => 'Professional Bookkeeping Services | BookKeep',
            'description' => 'Transform your business finances with expert bookkeeping services. Streamlined, accurate, and reliable financial management.',
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'title' => 'Bookkeeping Services | BookKeep',
            'description' => 'Comprehensive bookkeeping services including transaction recording, financial reporting, reconciliation, and more.',
        ]);
    }

    public function howItWorks()
    {
        return view('pages.how-it-works', [
            'title' => 'How It Works | BookKeep',
            'description' => 'Learn how our streamlined bookkeeping process helps you manage your business finances efficiently.',
        ]);
    }

    public function pricing()
    {
        $plans = \App\Models\Plan::where('is_active', true)
            ->orderBy('price', 'asc')
            ->get();

        return view('pages.pricing', [
            'title' => 'Pricing Plans | BookKeep',
            'description' => 'Transparent pricing for professional bookkeeping services. Choose a plan that fits your business needs.',
            'plans' => $plans,
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'About Us | BookKeep',
            'description' => 'Learn about our mission to provide exceptional bookkeeping services for modern businesses.',
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'title' => 'Contact Us | BookKeep',
            'description' => 'Get in touch with our team. We\'re here to help with all your bookkeeping needs.',
        ]);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Here you would typically save to database or send email
        // For now, we'll just redirect back with success message

        return redirect()->back()->with('success', 'Thank you for contacting us! We\'ll get back to you soon.');
    }
}

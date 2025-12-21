@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Transparent Pricing"
    subtitle="Choose the plan that fits your business needs"
    backgroundImage="https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=1920&q=80"
    height="min-h-[70vh]">
</x-hero>

<!-- Pricing Cards Section -->
<x-section 
    title="Simple, Straightforward Plans"
    subtitle="No hidden fees. Cancel anytime.">
    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto stagger-container">
        <!-- Starter Plan -->
        <div class="stagger-item">
            <x-pricing-card
                title="START UP"
                price="299"
                :features="[
                    '50 Transactions',
                    'Reports: Monthly',
                    'Reconciliation: 2 Accounts',
                    'Expense Categorization: Included',
                    'Support: Email',
                    'Reviews: Quarterly',
                    'AR/AP: Extra',
                    'Payroll: Extra',
                    'Tax Prep: Extra',
                    'Dedicated Bookkeeper: Extra',
                    'Financial Analysis: Extra',
                    'KPI Snapshot: Extra',
                    'Setup Cost: $350'
                ]"
                ctaText="Get Started"
                :ctaLink="route('contact')"
            />
        </div>

        <!-- Professional Plan (Highlighted) -->
        <div class="stagger-item">
            <x-pricing-card
                title="PRO"
                price="599"
                :features="[
                    '200 Transactions',
                    'Reports: Weekly + Monthly',
                    'Reconciliation: 4 Accounts',
                    'Expense Categorization: Included',
                    'Support: Priority',
                    'Reviews: Monthly',
                    'AR/AP: Included',
                    'Payroll: Extra',
                    'Tax Prep: Extra',
                    'Dedicated Bookkeeper: Extra',
                    'Financial Analysis: Extra',
                    'KPI Snapshot: Extra',
                    'Setup Cost: $500'
                ]"
                :highlighted="true"
                ctaText="Get Started"
                :ctaLink="route('contact')"
            />
        </div>

        <!-- Enterprise Plan -->
        <div class="stagger-item">
            <x-pricing-card
                title="ENTERPRISE"
                price="999"
                :features="[
                    '500 Transactions',
                    'Reports: Weekly + Monthly + YTD',
                    'Reconciliation: 6 Accounts',
                    'Expense Categorization: Included',
                    'Support: 24/7 Priority Support',
                    'Reviews: Weekly',
                    'AR/AP: Included',
                    'Payroll: Included',
                    'Tax Prep: Included',
                    'Dedicated Bookkeeper: Included',
                    'Financial Analysis: Included',
                    'KPI Snapshot: Included',
                    'Setup Cost: $750'
                ]"
                ctaText="Contact Sales"
                :ctaLink="route('contact')"
            />
        </div>
    </div>

    <p class="text-center text-[#4A5568] mt-8">All plans include secure data storage, bank-level encryption, and 24/7 dashboard access.</p>
</x-section>

<!-- Comparison Table Section -->
<x-section 
    title="Compare Plans"
    background="bg-[#F7FAFC]">
    <div class="max-w-5xl mx-auto overflow-x-auto">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-4 font-bold">Features</th>
                    <th class="text-center p-4 font-bold">Starter</th>
                    <th class="text-center p-4 font-bold bg-[#F7FAFC]">Professional</th>
                    <th class="text-center p-4 font-bold">Enterprise</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <tr>
                    <td class="p-4">Monthly Transactions</td>
                    <td class="text-center p-4">Up to 50</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">Up to 200</td>
                    <td class="text-center p-4">Unlimited</td>
                </tr>
                <tr>
                    <td class="p-4">Bank Reconciliation</td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4 bg-[#F7FAFC]">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Financial Reports</td>
                    <td class="text-center p-4">Monthly</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">Weekly</td>
                    <td class="text-center p-4">Real-time</td>
                </tr>
                <tr>
                    <td class="p-4">Accounts Payable/Receivable</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Payroll Support</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Dedicated Team</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">-</td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-[#0066CC] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Support Response Time</td>
                    <td class="text-center p-4">48 hours</td>
                    <td class="text-center p-4 bg-[#F7FAFC]">24 hours</td>
                    <td class="text-center p-4">Priority</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-section>

<!-- FAQ Section -->
<x-section 
    title="Frequently Asked Questions">
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">What happens if I exceed my transaction limit?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-[#4A5568]">
                We'll notify you before you reach your limit. You can either upgrade your plan or pay a small per-transaction fee for additional transactions.
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">Can I cancel anytime?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-[#4A5568]">
                Yes, absolutely. We offer month-to-month billing with no long-term contracts. Cancel anytime with 30 days notice.
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">Do you offer custom enterprise solutions?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-[#4A5568]">
                Yes, we work with larger organizations to create custom packages. Contact our sales team to discuss your specific needs.
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">What accounting software do you work with?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-[#4A5568]">
                We integrate with QuickBooks Online, Xero, FreshBooks, and most major accounting platforms. We can also set up a new system for you.
            </div>
        </div>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-[#002147] text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-blue-200">Start with a free consultation. No credit card required.</p>
        @guest
            <x-button href="{{ route('login') }}" variant="secondary" size="lg">
                Schedule Free Consultation
            </x-button>
        @else
            <x-button :href="auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard')" variant="secondary" size="lg">
                Go to Dashboard
            </x-button>
        @endguest
    </div>
</x-section>
@endsection

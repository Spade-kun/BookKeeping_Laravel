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
                title="Starter"
                price="299"
                :features="[
                    'Up to 50 monthly transactions',
                    'Monthly financial reports',
                    'Bank reconciliation',
                    'Expense categorization',
                    'Email support',
                    'Quarterly reviews'
                ]"
                ctaText="Get Started"
                :ctaLink="route('contact')"
            />
        </div>

        <!-- Professional Plan (Highlighted) -->
        <div class="stagger-item">
            <x-pricing-card
                title="Professional"
                price="599"
                :features="[
                    'Up to 200 monthly transactions',
                    'Weekly financial reports',
                    'Full account reconciliation',
                    'Accounts payable/receivable',
                    'Priority support',
                    'Monthly business reviews',
                    'Payroll assistance',
                    'Tax preparation support'
                ]"
                :highlighted="true"
                ctaText="Get Started"
                :ctaLink="route('contact')"
            />
        </div>

        <!-- Enterprise Plan -->
        <div class="stagger-item">
            <x-pricing-card
                title="Enterprise"
                price="999"
                :features="[
                    'Unlimited transactions',
                    'Real-time reporting',
                    'Dedicated bookkeeping team',
                    'Custom financial analysis',
                    '24/7 priority support',
                    'Weekly business reviews',
                    'Multi-entity support',
                    'CFO-level insights',
                    'Custom integrations'
                ]"
                ctaText="Contact Sales"
                :ctaLink="route('contact')"
            />
        </div>
    </div>

    <p class="text-center text-gray-600 mt-8">All plans include secure data storage, bank-level encryption, and 24/7 dashboard access.</p>
</x-section>

<!-- Comparison Table Section -->
<x-section 
    title="Compare Plans"
    background="bg-gray-50">
    <div class="max-w-5xl mx-auto overflow-x-auto">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-4 font-bold">Features</th>
                    <th class="text-center p-4 font-bold">Starter</th>
                    <th class="text-center p-4 font-bold bg-gray-50">Professional</th>
                    <th class="text-center p-4 font-bold">Enterprise</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <tr>
                    <td class="p-4">Monthly Transactions</td>
                    <td class="text-center p-4">Up to 50</td>
                    <td class="text-center p-4 bg-gray-50">Up to 200</td>
                    <td class="text-center p-4">Unlimited</td>
                </tr>
                <tr>
                    <td class="p-4">Bank Reconciliation</td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4 bg-gray-50">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Financial Reports</td>
                    <td class="text-center p-4">Monthly</td>
                    <td class="text-center p-4 bg-gray-50">Weekly</td>
                    <td class="text-center p-4">Real-time</td>
                </tr>
                <tr>
                    <td class="p-4">Accounts Payable/Receivable</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-gray-50">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Payroll Support</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-gray-50">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Dedicated Team</td>
                    <td class="text-center p-4">-</td>
                    <td class="text-center p-4 bg-gray-50">-</td>
                    <td class="text-center p-4">
                        <svg class="w-6 h-6 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Support Response Time</td>
                    <td class="text-center p-4">48 hours</td>
                    <td class="text-center p-4 bg-gray-50">24 hours</td>
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
            <div x-show="open" x-collapse class="mt-4 text-gray-600">
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
            <div x-show="open" x-collapse class="mt-4 text-gray-600">
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
            <div x-show="open" x-collapse class="mt-4 text-gray-600">
                Yes, we work with larger organizations to create custom packages. Contact our sales team to discuss your specific needs.
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">Is there a setup fee?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-gray-600">
                No, we don't charge any setup or onboarding fees. Your first month includes full setup and historical data review.
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                <h3 class="text-lg font-bold">What accounting software do you work with?</h3>
                <svg class="w-6 h-6 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-collapse class="mt-4 text-gray-600">
                We integrate with QuickBooks Online, Xero, FreshBooks, and most major accounting platforms. We can also set up a new system for you.
            </div>
        </div>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-black text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-gray-400">Start with a free consultation. No credit card required.</p>
        <x-button href="{{ route('contact') }}" variant="secondary" size="lg">
            Schedule Free Consultation
        </x-button>
    </div>
</x-section>
@endsection

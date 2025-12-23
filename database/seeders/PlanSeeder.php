<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Startup',
                'price' => 49.99,
                'billing_period' => 'monthly',
                'transaction_limit' => 100,
                'accounts_supported' => 1,
                'reports_frequency' => 'Monthly',
                'support_level' => 'Email Support',
                'features' => [
                    'Up to 100 transactions per month',
                    '1 business account',
                    'Monthly financial reports',
                    'Basic document upload',
                    'Email support',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Professional',
                'price' => 99.99,
                'billing_period' => 'monthly',
                'transaction_limit' => 500,
                'accounts_supported' => 3,
                'reports_frequency' => 'Bi-weekly',
                'support_level' => 'Priority Email Support',
                'features' => [
                    'Up to 500 transactions per month',
                    '3 business accounts',
                    'Bi-weekly financial reports',
                    'Unlimited document uploads',
                    'Priority email support',
                    'Quarterly tax preparation assistance',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 199.99,
                'billing_period' => 'monthly',
                'transaction_limit' => null, // Unlimited
                'accounts_supported' => null, // Unlimited
                'reports_frequency' => 'Weekly',
                'support_level' => '24/7 Priority Support',
                'features' => [
                    'Unlimited transactions',
                    'Unlimited business accounts',
                    'Weekly financial reports',
                    'Unlimited document uploads',
                    '24/7 priority support',
                    'Dedicated account manager',
                    'Custom reporting',
                    'Tax preparation included',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Startup Annual',
                'price' => 499.99,
                'billing_period' => 'yearly',
                'transaction_limit' => 100,
                'accounts_supported' => 1,
                'reports_frequency' => 'Monthly',
                'support_level' => 'Email Support',
                'features' => [
                    'Up to 100 transactions per month',
                    '1 business account',
                    'Monthly financial reports',
                    'Basic document upload',
                    'Email support',
                    'Save 17% with annual billing',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Professional Annual',
                'price' => 999.99,
                'billing_period' => 'yearly',
                'transaction_limit' => 500,
                'accounts_supported' => 3,
                'reports_frequency' => 'Bi-weekly',
                'support_level' => 'Priority Email Support',
                'features' => [
                    'Up to 500 transactions per month',
                    '3 business accounts',
                    'Bi-weekly financial reports',
                    'Unlimited document uploads',
                    'Priority email support',
                    'Quarterly tax preparation assistance',
                    'Save 17% with annual billing',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise Annual',
                'price' => 1999.99,
                'billing_period' => 'yearly',
                'transaction_limit' => null,
                'accounts_supported' => null,
                'reports_frequency' => 'Weekly',
                'support_level' => '24/7 Priority Support',
                'features' => [
                    'Unlimited transactions',
                    'Unlimited business accounts',
                    'Weekly financial reports',
                    'Unlimited document uploads',
                    '24/7 priority support',
                    'Dedicated account manager',
                    'Custom reporting',
                    'Tax preparation included',
                    'Save 17% with annual billing',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}

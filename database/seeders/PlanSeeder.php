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
        // Delete all existing plans (respecting foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Plan::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $plans = [
            [
                'name' => 'Start Up',
                'price' => 299.00,
                'billing_period' => 'monthly',
                'transaction_limit' => 50,
                'accounts_supported' => 2,
                'reports_frequency' => 'monthly',
                'support_level' => 'email',
                'features' => [
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
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Pro',
                'price' => 599.00,
                'billing_period' => 'monthly',
                'transaction_limit' => 200,
                'accounts_supported' => 4,
                'reports_frequency' => 'weekly',
                'support_level' => 'priority',
                'features' => [
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
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 999.00,
                'billing_period' => 'monthly',
                'transaction_limit' => 500,
                'accounts_supported' => 6,
                'reports_frequency' => 'daily',
                'support_level' => '24/7',
                'features' => [
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
                ],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}

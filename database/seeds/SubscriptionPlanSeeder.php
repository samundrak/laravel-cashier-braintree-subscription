<?php

use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    const MONTHLY_BILLING_CYCLE = 1;
    const ANNUAL_BILLING_CYCLE = 12;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name'          => 'Basic Annual',
                'plan_id'       => 'BASIC_ANNUAL',
                'billing_cycle' => SubscriptionPlanSeeder::ANNUAL_BILLING_CYCLE,
                'amount'        => 600,
                'descriptions'  => 'In basic annual 2 users, 2 workflows and unlimited invoices are allowed'
            ],
            [
                'name'          => 'Basic Monthly',
                'plan_id'       => 'BASIC_MONTHLY',
                'billing_cycle' => SubscriptionPlanSeeder::MONTHLY_BILLING_CYCLE,
                'amount'        => 60,
                'descriptions'  => 'Basic Monthly allowed 2 users, 2 workflows and unlimited invoices.'
            ],
            [
                'name'          => 'Enterprise Annual',
                'plan_id'       => 'ENTERPRISE_ANNUAL',
                'billing_cycle' => SubscriptionPlanSeeder::ANNUAL_BILLING_CYCLE,
                'amount'        => 3000,
                'descriptions'  => 'Enterprise Annual allows 10+ users, unlimited workflows and unlimited invoices'
            ],
            [
                'name'          => 'Enterprise Monthly',
                'plan_id'       => 'ENTERPRISE_MONTHLY',
                'billing_cycle' => SubscriptionPlanSeeder::MONTHLY_BILLING_CYCLE,
                'amount'        => 300,
                'descriptions'  => 'Enterprise monthly allows 10+ users, unlimited workflows and unlimited invoices',
            ],
            [
                'name'          => 'Plus Annual',
                'plan_id'       => 'PLUS_ANNUAL',
                'billing_cycle' => SubscriptionPlanSeeder::ANNUAL_BILLING_CYCLE,
                'amount'        => 1200,
                'descriptions'  => 'Plus Annual allows 5 users, 4 workflows and unlimited invoices'
            ],
            [
                'name'          => 'Plus Monthly',
                'plan_id'       => 'PLUS_MONTHLY',
                'billing_cycle' => SubscriptionPlanSeeder::MONTHLY_BILLING_CYCLE,
                'amount'        => 120,
                'descriptions'  => 'Plus monthly allows 5 users, 4 workflows and unlimited users.'
            ],
            [
                'name'          => 'Premium Annual',
                'plan_id'       => 'PREMIUM_ANNUAL',
                'billing_cycle' => SubscriptionPlanSeeder::ANNUAL_BILLING_CYCLE,
                'amount'        => 1800,
                'descriptions'  => 'Premium annual allows 10 users, 8 workflows and Unlimited invoices'
            ],
            [
                'name'          => 'Premium Monthly',
                'plan_id'       => 'PREMIUM_MONTHLY',
                'billing_cycle' => SubscriptionPlanSeeder::MONTHLY_BILLING_CYCLE,
                'amount'        => 180,
                'descriptions'  => 'Premium Monthly allows 10 users, 8 workflows and unlimited invoices'
            ],
            [
                'name'          => 'Starter',
                'plan_id'       => 'STARTER',
                'billing_cycle' => SubscriptionPlanSeeder::MONTHLY_BILLING_CYCLE,
                'amount'        => 0,
                'descriptions'  => 'Starter is free plan'
            ],
        ];

        foreach ($plans as $plan) {
            \App\SubscriptionPlan::firstOrCreate($plan);
        }
    }
}
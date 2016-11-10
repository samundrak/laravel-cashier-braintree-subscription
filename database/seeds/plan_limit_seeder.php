<?php

use Illuminate\Database\Seeder;

class plan_limit_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limits = [
            [
                'plan_id' => 1,
                'limit'   => 4,
            ],
            [
                'plan_id' => 2,
                'limit'   => 4,
            ],
            [
                'plan_id' => 3,
                'limit'   => 8,
            ],
            [
                'plan_id' => 4,
                'limit'   => 8,
            ],
            [
                'plan_id' => 5,
                'limit'   => 12,
            ],
            [
                'plan_id' => 6,
                'limit'   => 12,
            ],
            [
                'plan_id' => 7,
                'limit'   => 20,
            ],
            [
                'plan_id' => 8,
                'limit'   => 20,
            ],
            [
                'plan_id' => 9,
                'limit'   => 1,
            ],

        ];

        foreach ($limits as $limit) {
            \App\PlanLimit::firstOrCreate($limit);
        }
    }
}

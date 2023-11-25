<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            [
                'amount' => 1200000,
                'date' => Carbon::parse('2023-1-25')
            ],
            [
                'amount' => 1100000,
                'date' => Carbon::parse('2023-2-25')
            ],
            [
                'amount' => 800000,
                'date' => Carbon::parse('2023-3-25')
            ],
            [
                'amount' => 3700000,
                'date' => Carbon::parse('2023-4-25')
            ],
            [
                'amount' => 4000000,
                'date' => Carbon::parse('2023-5-25')
            ],
            [
                'amount' => 2200000,
                'date' => Carbon::parse('2023-6-25')
            ],
            [
                'amount' => 3000000,
                'date' => Carbon::parse('2023-7-25')
            ],
            [
                'amount' => 3500000,
                'date' => Carbon::parse('2023-8-25')
            ],
            [
                'amount' => 2900000,
                'date' => Carbon::parse('2023-9-25')
            ],
            [
                'amount' => 3100000,
                'date' => Carbon::parse('2023-10-25')
            ],
            [
                'amount' => 3000000,
                'date' => Carbon::parse('2023-11-25')
            ],
            [
                'amount' => 3200000,
                'date' => Carbon::parse('2023-12-25')
            ],
        ]);
    }
}

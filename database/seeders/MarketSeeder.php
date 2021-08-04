<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markets')->insert(
            [
                'code' => 'moex',
                'name' => 'Московская биржа',
                'website' => 'https://www.moex.com/',
            ],
        );
    }
}

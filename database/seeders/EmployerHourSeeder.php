<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployerHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        for ($i = 1; $i <= 20; $i++) {
            for($month = 1; $month < 4; $month++){
                for($day = 1; $day < 24; $day++){
                    DB::table('employer_hour')->insert([
                        'employer_id' => $i,
                        'quantity' => rand(4, 10),
                        'date' => '2022-' . $month . '-' . $day
                    ]);
                }

            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = ['qa', 'developer', 'SMM'];
        for ($i = 1; $i <= 20; $i++) {
            $salary_type =  rand(1, 2);
            DB::table('employers')->insert([
                'name' => "Employers №" . $i,
                'surname' => $i . "th",
                'salary_type' => $salary_type,
                'salary' => ($salary_type == 1) ? rand(3, 15) * 100 : rand(5, 40),
                'department_id' => rand(1, 3),
                'birthday' => rand(1985, 1999) . "-" . rand(1, 12) . '-' . rand(1, 12),
                'position' => $positions[rand(0,2)]
            ]);
        }
    }
}

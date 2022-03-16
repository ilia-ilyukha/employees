<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['Testing', 'Development', 'Content'];
        $departments_code = ['testing', 'development', 'content'];
        for ($i = 0; $i <= 2; $i++) {
            DB::table('departments')->insert([
                'name' => $departments[$i],
                'codename' => $departments_code[$i]
            ]);
        }
    }
}

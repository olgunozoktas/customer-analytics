<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Department;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create([
             'email' => 'test@gmail.com'
         ]);

         Department::create(['name' => 'Muhasebe']);
         Department::create(['name' => 'Pazarlama']);

         Department::all()->each(function($department) {
             Customer::factory(10)->create([
                 'department_id' => $department->id
             ]);
         });
    }
}

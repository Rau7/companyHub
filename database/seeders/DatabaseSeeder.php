<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Create 50 companies and their employees
        Company::factory()->count(50)->create()->each(function ($company) {
            Employee::factory()->count(rand(1, 3))->create([
                'company_id' => $company->id
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;
use Database\Seeders\AdminUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Create 50 companies
        Company::factory(50)->create()->each(function ($company) {
            // For each company, create between 1 and 3 employees
            Employee::factory(fake()->numberBetween(1, 3))->create([
                'company_id' => $company->id
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create sample invoice
        $user->invoices()->create([
            'client_name' => 'John Client',
            'client_email' => 'john@example.com',
            'amount' => 200.00,
            'description' => 'Web development services for company website redesign. Includes frontend development, responsive design, and basic SEO optimization.',
        ]);

        // Create additional sample invoices
        $user->invoices()->create([
            'client_name' => 'Sarah Johnson',
            'client_email' => 'sarah@techstartup.com',
            'amount' => 1500.00,
            'description' => 'Complete e-commerce platform development with payment integration and inventory management system.',
        ]);

        $user->invoices()->create([
            'client_name' => 'Mike Wilson',
            'client_email' => 'mike@consulting.com',
            'amount' => 750.00,
            'description' => 'Mobile app development for iOS and Android platforms. Includes user authentication and push notifications.',
        ]);
    }
}

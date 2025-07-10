<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->invoices()->create([
            'client_name' => 'John Client',
            'client_email' => 'john@example.com',
            'amount' => 200.00,
            'description' => 'Web development services',
        ]);
    }
}

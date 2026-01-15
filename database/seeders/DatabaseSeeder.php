<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting database seeding...');

        // 1. Buat admin user
        User::factory()->create([
            'name'              => 'Administrator',
            'email'             => 'admin@sikomart.com',
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->command->info('Admin user created: admin@sikomart.com');

        // 2. Seed kategori komik
        $this->call(CategorySeeder::class);

        // 3. Seed produk komik
        $this->call(ProductSeeder::class);

        $this->command->newLine();
        $this->command->info('Database seeding completed!');
        $this->command->info('Admin login: admin@sikomart.com / password');
    }
}

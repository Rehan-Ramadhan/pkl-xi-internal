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
            'email'             => 'admin@example.com',
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->command->info('Admin user created: admin@example.com');

        // 2. Buat beberapa customer
        User::factory(10)->create(['role' => 'customer']);
        $this->command->info('10 customer users created');

        // 3. Seed kategori KOMIK
        $this->call(CategorySeeder::class);

        // 4. Seed produk KOMIK (MANUAL, BUKAN RANDOM)
        $this->call(ProductSeeder::class);

        $this->command->newLine();
        $this->command->info('Database seeding completed!');
        $this->command->info('Admin login: admin@example.com / password');
    }
}

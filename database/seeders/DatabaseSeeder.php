<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Shop\Database\Seeders\ShopDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if ($this->command->confirm('apakah Anda ingin menyegarkan migrasi sebelum melakukan seeding, ini akan menghapus semua data lama!')) {
            $this->command->call('migrate:refresh');
            $this->command->info('data dibersihkan, mulai dari database kosong');
        }

        User::factory()->create();
        $this->command->info('sampel user seeders.');

        if ($this->command->confirm('apakah Anda ingin seed beberapa produk sampel')){
            $this->call(ShopDatabaseSeeder::class);
        }
        
    }
}

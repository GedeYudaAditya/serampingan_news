<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Gede Yuda Aditya',
            'username' => 'gede_yuda_aditya',
            'email' => 'yuda.aditya@undiksha.ac.id',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'name' => 'Kadek Ary Sukaraharja',
            'username' => 'kadek_ary_sukaraharja',
            'email' => 'kadek.ary@undiksha.ac.id',
            'password' => bcrypt('12345')
        ]);

        Category::factory(5)->create();

        Berita::factory(20)->create();
    }
}

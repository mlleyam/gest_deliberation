<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // L'ordre compte : les filières doivent exister avant les utilisateurs
        $this->call([
            ReferentielsSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
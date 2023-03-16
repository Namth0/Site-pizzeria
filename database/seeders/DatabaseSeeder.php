<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Apps\Models\Pizza;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
       
        Pizza::factory()
            ->count(30)
            ->hasEmplacements(5)
            ->create();

    }
}

<?php

namespace Database\Seeders;

use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleFactory::new()->admin()->create();
        RoleFactory::new()->editor()->create();     
        RoleFactory::new()->viewer()->create();
    }
}

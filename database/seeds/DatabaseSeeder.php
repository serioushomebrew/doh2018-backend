<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
         $this->call(UserSeeder::class);
         $this->call(LevelSeeder::class);
         $this->call(ChallengeSeeder::class);
    }
}

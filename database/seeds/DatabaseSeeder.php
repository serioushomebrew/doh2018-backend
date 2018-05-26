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
         $this->call(UsersTableSeeder::class);
         $this->call(LevelTableSeeder::class);
         $this->call(ChallengeTableSeeder::class);
    }
}

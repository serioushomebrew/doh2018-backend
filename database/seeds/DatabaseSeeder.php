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
         $this->call(SkillSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(LevelSeeder::class);
         $this->call(ChallengeSeeder::class);
    }
}

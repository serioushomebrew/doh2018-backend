<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\App\Skill::class)->create(['name' => 'Blockchain']);
        factory(\App\Skill::class)->create(['name' => 'Crypto\'s']);
        factory(\App\Skill::class)->create(['name' => 'Phishing']);
        factory(\App\Skill::class)->create(['name' => 'Ransomware']);
    }
}

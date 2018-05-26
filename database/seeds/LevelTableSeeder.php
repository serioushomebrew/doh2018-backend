<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            factory(\App\Level::class)->create([
                'points'      => $i * 100,
                'name'        => 'Level ' . $i,
                'description' => 'This is level ' . $i,
            ]);
        }
    }
}

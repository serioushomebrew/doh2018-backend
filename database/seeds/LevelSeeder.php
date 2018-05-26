<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            factory(\App\Level::class)->create([
                'points'      => $i * 100,
                'name'        => 'Level ' . $i,
                'description' => 'This is level ' . $i,
                'image'       => url('/img/level-' . $i . '.svg'),
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ChallengeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\App\Challenge::class)->create([
            'level_id'    => \App\Level::query()->orderBy('points')->first(),
            'name'        => 'Wordpress website has been hacked',
            'description' => 'My wordpress website has been hacked the url is http://www.isellnicecookies.com',
        ]);
        factory(\App\Challenge::class)->create([
            'level_id'    => \App\Level::query()->orderBy('points', 'desc')->first(),
            'name'        => 'my website is under a DDOS attack',
            'description' => 'My website is now under DDOS attack for 2 days, the url is http://www.isellgoodcookies.com',
        ]);
    }
}

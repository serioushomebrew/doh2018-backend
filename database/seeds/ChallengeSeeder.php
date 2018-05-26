<?php

use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var \App\User $user */
        $user = factory(\App\User::class)->create([
            'name'        => 'John',
            'email'       => 'john@doe.nl',
            'description' => 'Owner of multiple cookie selling sites',
        ]);

        factory(\App\Challenge::class)->create([
            'user_id'     => $user->id,
            'level_id'    => \App\Level::query()->orderBy('points')->first(),
            'name'        => 'Wordpress website has been hacked',
            'description' => 'My wordpress website has been hacked the url is http://www.isellnicecookies.com',
        ]);
        factory(\App\Challenge::class)->create([
            'user_id'     => $user->id,
            'level_id'    => \App\Level::query()->orderBy('points', 'desc')->first(),
            'name'        => 'My website is under a DDOS attack',
            'description' => 'My website is now under DDOS attack for 2 days, the url is http://www.isellgoodcookies.com',
        ]);
    }
}

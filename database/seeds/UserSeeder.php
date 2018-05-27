<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\App\User::class)->create([
            'type'  => \App\User::TYPE_USER,
            'name'  => 'Koen',
            'email' => 'koen@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'type'      => \App\User::TYPE_USER,
            'name'      => 'Crone',
            'email'     => 'corne@doh.nl',
            'api_token' => 'e7BO3PwUXPZrGT3lPJUQKip6hD5tBTIcPG2aO7psGDKLet6SiOBWm9e4PnoGrAo0',
        ]);
        factory(\App\User::class)->create([
            'type'  => \App\User::TYPE_USER,
            'name'  => 'Timo',
            'email' => 'Timo@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'type'  => \App\User::TYPE_USER,
            'name'  => 'Nils',
            'email' => 'nils@doh.nl',
        ]);

        /** @var \App\User $hacker */
        $hacker = factory(\App\User::class)->create([
            'type'      => \App\User::TYPE_HACKER,
            'points'    => 480,
            'name'      => 'Elliot',
            'email'     => 'elliot@doh.nl',
            'latitude'  => 52.065474,
            'longitude' => 4.481966,
            'api_token' => 'lV475jlAla8aCir45PAtNdPlbG46ih5Ji5bqwzJeFQLU23aXAvYECSYUj7GirgsW',
        ]);
        $hacker->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'Privacy'])->id,
        ]);
        /** @var \App\User $hacker */
        $hacker = factory(\App\User::class)->create([
            'type'      => \App\User::TYPE_HACKER,
            'points'    => 210,
            'name'      => 'Hacker 2',
            'email'     => 'hacker2@doh.nl',
            'latitude'  => 52.056500,
            'longitude' => 4.504377,
        ]);
        $hacker->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DNS'])->id,
            \App\Skill::query()->firstOrCreate(['name' => 'DDoS'])->id,
            \App\Skill::query()->firstOrCreate(['name' => 'WordPress'])->id,
        ]);

        /** @var \App\User $adviser */
        $adviser = factory(\App\User::class)->create([
            'type'        => \App\User::TYPE_ADVISER,
            'name'        => 'Jane',
            'email'       => 'jane@doh.nl',
            'description' => 'Developer at Bits of Freedom',
        ]);
        $adviser->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'Privacy'])->id,
        ]);
    }
}

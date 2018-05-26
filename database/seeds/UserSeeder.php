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
            'type'  => \App\User::TYPE_USER,
            'name'  => 'Crone',
            'email' => 'corne@doh.nl',
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
            'type'   => \App\User::TYPE_HACKER,
            'points' => 100,
            'name'   => 'Hacker 1',
            'email'  => 'hacker1@doh.nl',
        ]);
        $hacker->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'Privacy'])->id,
        ]);
        /** @var \App\User $hacker */
        $hacker = factory(\App\User::class)->create([
            'type'        => \App\User::TYPE_HACKER,
            'points'      => 210,
            'name'        => 'Hacker 2',
            'description' => 'Developer at Bits of Freedom',
            'email'       => 'hacker2@doh.nl',
        ]);
        $hacker->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DNS'])->id,
            \App\Skill::query()->firstOrCreate(['name' => 'DDOS attacks'])->id,
        ]);
    }
}

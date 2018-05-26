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

        factory(\App\User::class)->create([
            'type'  => \App\User::TYPE_HACKER,
            'name'  => 'Hacker 1',
            'email' => 'hacker1@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'type'  => \App\User::TYPE_HACKER,
            'name'  => 'Hacker 2',
            'email' => 'hacker2@doh.nl',
        ]);

        factory(\App\User::class)->create([
            'type'        => \App\User::TYPE_ADVISER,
            'name'        => 'Jan',
            'description' => 'Developer at Bits of Freedom',
            'email'       => 'jan@adviser.nl',
        ]);
    }
}

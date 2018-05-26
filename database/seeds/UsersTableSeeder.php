<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\App\User::class)->create([
            'name'  => 'Koen',
            'email' => 'koen@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'name'  => 'Crone',
            'email' => 'corne@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'name'  => 'Timo',
            'email' => 'Timo@doh.nl',
        ]);
        factory(\App\User::class)->create([
            'name'  => 'Nils',
            'email' => 'nils@doh.nl',
        ]);
    }
}

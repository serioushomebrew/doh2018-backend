<?php

use App\Challenge;
use App\Level;
use App\User;
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
        $this->createChallengeWebsiteOffline($user);
        $this->createChallengeWordpressHacked($user);
        $this->createChallengeWebsiteDdos($user);
        $this->createChallengeTransIpDdos();
    }

    /**
     * @param User $user
     * @return Challenge
     */
    protected function createChallengeWebsiteOffline(User $user): Challenge
    {
        /** @var User $hacker */
        $hacker = \App\User::query()->hackers()->first();
        /** @var Challenge $challenge */
        $challenge = factory(Challenge::class)->create([
            'status'        => Challenge::STATUS_COMPLETED,
            'reward_points' => 150,
            'user_id'       => $user->id,
            'level_id'      => Level::query()->orderBy('points', 'desc')->first(),
            'name'          => 'My website is offline',
            'description'   => 'I just bought a new domain',
        ]);
        $challenge->users()->attach($hacker);
        $challenge->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'Privacy'])->id,
        ]);
        $challenge->comments()->create([
            'user_id'     => $hacker->id,
            'description' => 'Did you configured the DNS settings?',
        ]);
        $challenge->comments()->create([
            'user_id'     => $user->id,
            'description' => 'Thanks I didnt\'t configure them',
        ]);

        return $challenge;
    }

    /**
     * @param User $user
     * @return Challenge
     */
    protected function createChallengeWordpressHacked(User $user): Challenge
    {
        /** @var Challenge $challenge */
        $challenge = factory(Challenge::class)->create([
            'user_id'     => $user->id,
            'level_id'    => Level::query()->orderBy('points')->first(),
            'name'        => 'Wordpress website has been hacked',
            'city'        => 'Zoetermeer',
            'latitude'    => 52.0464953,
            'longitude'   => 4.5145502,
            'description' => 'My wordpress website has been hacked the url is http://www.isellnicecookies.com',
        ]);
        $challenge->files()->create([
            'name'        => 'wp-config.php',
            'description' => 'The wordpress config file',
            'size'        => '100 KB',
        ]);
        $challenge->files()->create([
            'name'        => 'Apache error file',
            'description' => null,
            'size'        => '3.2 MB',
        ]);
        $challenge->skills()->sync([
            \App\Skill::query()->create(['name' => 'Wordpress'])->id,
        ]);

        return $challenge;
    }

    /**
     * @param User $user
     * @return Challenge
     */
    protected function createChallengeWebsiteDdos(User $user): Challenge
    {
        /** @var Challenge $challenge */
        $challenge = factory(Challenge::class)->create([
            'user_id'       => $user->id,
            'reward_points' => 150,
            'status'        => Challenge::STATUS_OPEN,
            'level_id'      => Level::query()->orderBy('points', 'desc')->first(),
            'name'          => 'My website is under a DDOS attack',
            'city'          => 'Zoetermeer',
            'latitude'      => 52.0464953,
            'longitude'     => 4.5145502,
            'description'   => 'My website is now under DDOS attack for 2 days, the url is http://www.isellgoodcookies.com',
        ]);
        $challenge->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DDOS'])->id,
        ]);
        $challenge->files()->create([
            'name'        => 'request.logs',
            'description' => null,
            'size'        => '1.1 GB',
        ]);

        return $challenge;
    }

    /**
     * @return void
     */
    protected function createChallengeTransIpDdos(): void
    {
        /** @var Challenge $challenge */
        $challenge = factory(Challenge::class)->create([
            'user_id'     => factory(\App\User::class)->create([
                'name'        => 'jake',
                'email'       => 'jake@transip.nl',
                'description' => 'Developer at TransIp',
            ]),
            'status'      => Challenge::STATUS_OPEN,
            'level_id'    => Level::query()->orderBy('points', 'desc')->first(),
            'name'        => 'All servers are under DDOS attacks',
            'description' => 'Can anyone help me with this.<br>Reward is 1 year free stack hosting with 10TB space.',
        ]);
        $challenge->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DDOS'])->id,
        ]);
        $challenge->files()->create([
            'name'        => 'request.logs',
            'description' => null,
            'size'        => '5.3 GB',
        ]);
    }
}

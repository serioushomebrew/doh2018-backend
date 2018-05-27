<?php

use App\Challenge;
use App\Http\Controllers\AddressesController;
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
        $this->createChallengeWordPressHacked($user);
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
            'postal_code'   => '2266AJ',
            'house_number'  => '34',
            'latitude'      => 52.0464953,
            'longitude'     => 4.5145502,
        ]);
        (new AddressesController())->updateChallenge($challenge);
        $challenge->users()->syncWithoutDetaching([
            $hacker->id => ['accepted_at' => now()],
        ]);
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
    protected function createChallengeWordPressHacked(User $user): Challenge
    {
        /** @var Challenge $challenge */
        $challenge = factory(Challenge::class)->create([
            'user_id'       => $user->id,
            'level_id'      => Level::query()->orderBy('points')->first(),
            'reward_points' => 150,
            'name'          => 'WordPress website has been hacked',
            'city'          => 'Ommen',
            'description'   => 'My wordpress website has been hacked the url is http://www.isellnicecookies.com',
            'postal_code'   => '7731BD',
            'house_number'  => '3',
        ]);
        (new AddressesController())->updateChallenge($challenge);
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
            \App\Skill::query()->firstOrCreate(['name' => 'WordPress'])->id,
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
            'name'          => 'My website is under a DDoS attack',
            'city'          => 'Zoetermeer',
            'description'   => 'My website is now under DDoS attack for 2 days, the url is http://www.isellgoodcookies.com',
            'postal_code'   => '2266AJ',
            'house_number'  => '34',
        ]);
        (new AddressesController())->updateChallenge($challenge);
        $challenge->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DDoS'])->id,
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
            'user_id'       => factory(\App\User::class)->create([
                'name'        => 'jake',
                'email'       => 'jake@transip.nl',
                'description' => 'Developer at TransIp',
            ]),
            'status'        => Challenge::STATUS_OPEN,
            'level_id'      => Level::query()->orderBy('points', 'desc')->first(),
            'reward_points' => 1000,
            'reward_gift'   => '1 year free stack hosting with 10TB of space',
            'name'          => 'All servers are under DDoS attacks',
            'description'   => 'Can anyone help me with this',
            'postal_code'   => '2181HS',
            'house_number'  => '36',
        ]);
        (new AddressesController())->updateChallenge($challenge);
        $challenge->skills()->sync([
            \App\Skill::query()->firstOrCreate(['name' => 'DDoS'])->id,
        ]);
        $challenge->files()->create([
            'name'        => 'request.logs',
            'description' => null,
            'size'        => '5.3 GB',
        ]);
    }
}

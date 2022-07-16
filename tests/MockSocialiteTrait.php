<?php

namespace Tests;

use App\Models\User;
use Mockery\MockInterface;

trait MockSocialiteTrait
{
    public function mockSocialite(
        string $provider,
        ?User $user = null,
        ?string $avatar = ""
    ) {
        $user = $user ?? User::factory()->make();
        $avatar = empty($avatar) ? "https://images/1.jpg" : $avatar;

        $socialiteUser = $this->mock(
            Laravel\Socialite\Two\User::class,
            function (MockInterface $mock) use ($user, $avatar) {
                $mock->shouldReceive("getName")->andReturn($user->name);
                $mock->shouldReceive("getEmail")->andReturn($user->email);
                $mock->shouldReceive("getAvatar")->andReturn($avatar);
            }
        );

        $provider = $this->mock($provider, function (MockInterface $mock) use (
            $socialiteUser
        ) {
            $mock->shouldReceive("stateless->user")->andReturn($socialiteUser);
        });

        $stub = $this->mock(Socialite::class, function (
            MockInterface $mock
        ) use ($provider) {
            $mock->shouldReceive("driver")->andReturn($provider);
        });

        // Replace Socialite Instance with our mock
        return $stub;
    }
}

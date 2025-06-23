<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Facades\User;
use Fkrzski\SteamApi\SteamApi;

it('returns valid instance of user facade', function (): void {
    $user = SteamApi::user();

    expect($user)->toBeInstanceOf(User::class);
});

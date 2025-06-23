<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi;

use Fkrzski\SteamApi\Facades\User;

final class SteamApi
{
    /**
     * Returns an instance of the User facade for interacting with ISteamUser-related endpoints.
     */
    public static function user(): User
    {
        return new User;
    }
}

<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi\Dtos\User;

final readonly class ResolveVanityUrlDto
{
    /**
     * @var string|null The resolved Steam ID, if successful.
     */
    public ?string $steamId;

    /**
     * @param  int  $success  Indicates whether the request success state.
     * @param  string|null  $message  Optional message providing additional information about the request.
     * @param  string|null  $steamid  The resolved Steam ID, if available.
     */
    public function __construct(
        public int $success,
        public ?string $message = null,
        ?string $steamid = null,
    ) {
        $this->steamId = $steamid;
    }
}

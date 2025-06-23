<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi\Facades;

use Fkrzski\SteamApi\Dtos\User\ResolveVanityUrlDto;
use Fkrzski\SteamApi\Requests\User\ResolveVanityUrl;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

final class User extends BaseFacade
{
    /**
     * @param  string  $vanityUrl  Custom Steam ID of the user.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resolveVanityUrl(string $vanityUrl, bool $throwOnNoMatch = true): ResolveVanityUrlDto
    {
        /** @var ResolveVanityUrlDto $dto */
        $dto = $this->send(new ResolveVanityUrl($vanityUrl, $throwOnNoMatch));

        return $dto;
    }
}

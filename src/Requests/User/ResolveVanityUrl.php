<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi\Requests\User;

use Fkrzski\SteamApi\Dtos\User\ResolveVanityUrlDto;
use Fkrzski\SteamApi\Exceptions\NoMatchException;
use InvalidArgumentException;
use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class ResolveVanityUrl extends Request
{
    /**
     * {@inheritdoc}
     */
    protected Method $method = Method::GET;

    /**
     * @param  string  $vanityUrl  The vanity URL to resolve.
     */
    public function __construct(
        private readonly string $vanityUrl,
        private readonly bool $throwOnNoMatch = true,
    ) {
        if ($this->vanityUrl === '' || $this->vanityUrl === '0') {
            throw new InvalidArgumentException('Vanity URL cannot be empty.');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/ISteamUser/ResolveVanityURL/v1';
    }

    /**
     * @throws JsonException
     * @throws NoMatchException
     */
    public function createDtoFromResponse(Response $response): ResolveVanityUrlDto
    {
        /** @var array{success: int, steamid?: string, message?: string} $responseData */
        $responseData = $response->json('response');

        $dto = new ResolveVanityUrlDto(...$responseData);

        if ($dto->steamId === null && $this->throwOnNoMatch) {
            throw new NoMatchException('No matching Steam ID found for the provided vanity URL: '.$this->vanityUrl);
        }

        return $dto;
    }

    /**
     * {@inheritDoc}
     */
    protected function defaultQuery(): array
    {
        return [
            'vanityurl' => $this->vanityUrl,
        ];
    }
}

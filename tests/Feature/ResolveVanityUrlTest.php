<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Exceptions\NoMatchException;
use Fkrzski\SteamApi\Requests\User\ResolveVanityUrl;
use Fkrzski\SteamApi\SteamApi;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('throws exception when vanity url is empty', function (): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Vanity URL cannot be empty.');

    SteamApi::user()->resolveVanityUrl('');
});

it('throws exception when not matched by default', function (): void {
    MockClient::global([
        ResolveVanityUrl::class => MockResponse::make([
            'response' => [
                'success' => 42,
                'message' => 'No match',
            ],
        ], 200, []),
    ]);

    $this->expectException(NoMatchException::class);
    $this->expectExceptionMessage('No matching Steam ID found for the provided vanity URL: test');

    SteamApi::user()->resolveVanityUrl('test');
});

it('returns dto when throw on not match is set to false', function (): void {
    MockClient::global([
        ResolveVanityUrl::class => MockResponse::make([
            'response' => [
                'success' => 42,
                'message' => 'No match',
            ],
        ], 200, []),
    ]);

    $dto = SteamApi::user()->resolveVanityUrl('test', false);

    expect($dto->steamId)->toBeNull()
        ->and($dto->success)->toBe(42)
        ->and($dto->message)->toBe('No match');
});

it('returns dto when steam id is matched', function (): void {
    MockClient::global([
        ResolveVanityUrl::class => MockResponse::make([
            'response' => [
                'success' => 1,
                'steamid' => '776561198000000001',
            ],
        ], 200, []),
    ]);

    $dto = SteamApi::user()->resolveVanityUrl('test', false);

    expect($dto->steamId)->toBe('776561198000000001')
        ->and($dto->success)->toBe(1)
        ->and($dto->message)->toBeNull();
});

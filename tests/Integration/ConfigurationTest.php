<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Config;
use Fkrzski\SteamApi\Connectors\SteamApiConnector;
use Saloon\RateLimitPlugin\Stores\FileStore;
use Saloon\RateLimitPlugin\Stores\MemoryStore;

it('steam connector uses api key set in config', function (): void {
    $apiKey = '1234567890abcdef1234567890abcdef';

    Config::setApiKey($apiKey);

    $connector = new SteamApiConnector;

    expect($connector->query()->get('key'))->toBe($apiKey)
        ->and($connector->query()->get('key'))->toBe(Config::getApiKey());
});

it('steam connector uses default rate limit store', function (): void {
    Config::setApiKey('1234567890abcdef1234567890abcdef');

    $connector = new SteamApiConnector;

    expect($connector->rateLimitStore())->toBeInstanceOf(FileStore::class);
});

it('steam connector uses rate limit store set in config', function (): void {
    $rateLimitStore = new MemoryStore;

    Config::setApiKey('1234567890abcdef1234567890abcdef');
    Config::setRateLimitStore($rateLimitStore);

    $connector = new SteamApiConnector;

    expect($connector->rateLimitStore())->toBeInstanceOf($rateLimitStore::class)
        ->and($connector->rateLimitStore())->toBeInstanceOf(Config::getRateLimitStore()::class);
});

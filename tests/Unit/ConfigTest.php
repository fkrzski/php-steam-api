<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Config;
use Saloon\RateLimitPlugin\Stores\MemoryStore;

it('correctly sets api key', function (): void {
    $apiKey = '1234567890abcdef1234567890abcdef';

    Config::setApiKey($apiKey);

    expect(Config::getApiKey())->toBe($apiKey);
});

it('correctly throws exception when api key is not set', function (): void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('API key is not set. Please set it using SteamApi::setApiKey().');

    Config::getApiKey();
});

it('correctly sets rate limit store', function (): void {
    $rateLimitStore = new MemoryStore;

    Config::setRateLimitStore($rateLimitStore);

    expect(Config::getRateLimitStore())->toBe($rateLimitStore);
});

it('correctly sets file store path', function (): void {
    $fileStorePath = 'file/store/path';

    Config::setFileStorePath($fileStorePath);

    expect(Config::getFileStorePath())->toBe($fileStorePath);
});

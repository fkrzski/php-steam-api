<?php

declare(strict_types=1);

use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\RateLimitPlugin\Stores\MemoryStore;

pest()
    ->printer()
    ->compact();

pest()
    ->beforeEach(function (): void {
        Config::preventStrayRequests();
    });

pest()
    ->beforeEach(function (): void {
        Fkrzski\SteamApi\Config::reset();
    })
    ->in('Unit', 'Integration');

pest()
    ->beforeEach(function (): void {
        Fkrzski\SteamApi\Config::setApiKey('1234567890abcdef1234567890abcdef');
        Fkrzski\SteamApi\Config::setRateLimitStore(new MemoryStore);
        MockClient::destroyGlobal();
    })
    ->in('Feature');

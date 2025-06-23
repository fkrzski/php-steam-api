<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Facades\BaseFacade;

arch()->preset()->php();
arch()->preset()->security();

arch('base')
    ->expect('Fkrzski\SteamApi')
    ->toUseStrictEquality()
    ->toHavePropertiesDocumented()
    ->toHaveMethodsDocumented();

arch('connectors')
    ->expect('Fkrzski\SteamApi\Connectors')
    ->toBeSaloonConnector()
    ->toUseAcceptsJsonTrait()
    ->toUseAlwaysThrowOnErrorsTrait()
    ->toHaveRateLimits();

arch('dtos')
    ->expect('Fkrzski\SteamApi\Dtos')
    ->toBeClasses()
    ->toBeReadonly();

arch('exceptions')
    ->expect('Fkrzski\SteamApi\Exceptions')
    ->toBeClasses()
    ->toExtend(Exception::class);

arch('facades')
    ->expect('Fkrzski\SteamApi\Facades\User')
    ->toExtend(BaseFacade::class);

arch('requests')
    ->expect('Fkrzski\SteamApi\Requests')
    ->toBeSaloonRequest();

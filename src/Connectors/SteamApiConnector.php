<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi\Connectors;

use Fkrzski\SteamApi\Config;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\FileStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class SteamApiConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasRateLimits;

    /**
     * {@inheritDoc}
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.steampowered.com/';
    }

    /**
     * {@inheritDoc}
     */
    protected function defaultQuery(): array
    {
        return [
            'key' => Config::getApiKey(),
        ];
    }

    /**
     * {@inheritDoc}
     *
     * @return array<int, Limit>
     */
    protected function resolveLimits(): array
    {
        return [
            Limit::allow(200)->everyMinute(),
            Limit::allow(100_000)->everyDay(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function resolveRateLimitStore(): RateLimitStore
    {
        return Config::getRateLimitStore() ?? new FileStore(Config::getFileStorePath() ?? __DIR__.'/../../cache');
    }
}

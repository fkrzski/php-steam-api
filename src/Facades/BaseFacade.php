<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi\Facades;

use Fkrzski\SteamApi\Connectors\SteamApiConnector;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;

abstract class BaseFacade
{
    /**
     * Sends the request and returns the response.
     *
     * @param  Request  $request  The request to send.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    final public function send(Request $request): mixed
    {
        return (new SteamApiConnector)->send($request)->dtoOrFail();
    }
}

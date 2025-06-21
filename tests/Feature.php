<?php

declare(strict_types=1);

use Fkrzski\SteamApi\Example;

it('foo', function (): void {
    $example = new Example;

    $result = $example->foo();

    expect($result)->toBe('bar');
});

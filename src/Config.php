<?php

declare(strict_types=1);

namespace Fkrzski\SteamApi;

use RuntimeException;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;

final class Config
{
    /**
     * The API key for authenticating requests to the Steam API.
     */
    private static ?string $apiKey = null;

    /**
     * The rate limit store for managing rate limits.
     */
    private static ?RateLimitStore $rateLimitStore = null;

    /**
     * The file store path for storing rate limit data.
     * This is used when the default FileStore is used.
     */
    private static ?string $fileStorePath = null;

    /**
     * Sets the API key for authenticating requests to the Steam API.
     *
     * @param  string  $apiKey  The API key for authenticating requests to the Steam API.
     */
    public static function setApiKey(string $apiKey): void
    {
        self::$apiKey = $apiKey;
    }

    /**
     * Checks if the API key is set and returns it.
     */
    public static function getApiKey(): string
    {
        if (self::$apiKey === null) {
            throw new RuntimeException('API key is not set. Please set it using SteamApi::setApiKey().');
        }

        return self::$apiKey;
    }

    /**
     * Sets the rate limit store for managing rate limits.
     *
     * @param  RateLimitStore  $rateLimitStore  The rate limit store for managing rate limits.
     */
    public static function setRateLimitStore(RateLimitStore $rateLimitStore): void
    {
        self::$rateLimitStore = $rateLimitStore;
    }

    /**
     * Returns the rate limit store for managing rate limits.
     */
    public static function getRateLimitStore(): ?RateLimitStore
    {
        return self::$rateLimitStore;
    }

    /**
     * Sets the file store path for storing rate limit data.
     */
    public static function setFileStorePath(?string $fileStorePath): void
    {
        self::$fileStorePath = $fileStorePath;
    }

    /**
     * Returns the file store path for storing rate limit data.
     */
    public static function getFileStorePath(): ?string
    {
        return self::$fileStorePath;
    }

    /**
     * Resets the configuration to its default state.
     */
    public static function reset(): void
    {
        self::$apiKey = null;
        self::$rateLimitStore = null;
    }
}

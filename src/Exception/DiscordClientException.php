<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\Exception;

use Exception;
use Throwable;

class DiscordClientException extends Exception
{
    /**
     * Unexpected happened during authentication.
     *
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function authenticate(?Throwable $previous = null): static
    {
        return new self(message: "Authentication failed.", previous: $previous);
    }

    /**
     * Unexpected happened during authentication.
     *
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function sendRequest(?Throwable $previous = null): static
    {
        return new self(message: "HTTP request failed.", previous: $previous);
    }

    /**
     * Unexpected happened during handling of request result.
     *
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function result(?Throwable $previous = null): static
    {
        return new self(message: "An error occurred while handling result.", previous: $previous);
    }

    /**
     * Given key in result is null during getOrFail().
     *
     * @param string $key
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function resultGet(string $key, ?Throwable $previous = null): static
    {
        return new self(message: "Could not get value for key '{$key}' in result.", previous: $previous);
    }
}
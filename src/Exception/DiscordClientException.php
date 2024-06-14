<?php

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
}
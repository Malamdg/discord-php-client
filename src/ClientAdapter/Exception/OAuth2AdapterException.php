<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Exception;

use Throwable;

class OAuth2AdapterException extends ClientAdapterException
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
     * Unexpected happened during request sending.
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
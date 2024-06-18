<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use DateTime;
use DateTimeImmutable;

/**
 * @internal
 */
readonly class AccessToken
{
    public function __construct(
        private string            $token,
        private DateTimeImmutable $expiration,
    ) {
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Is access token expired ?
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return (new DateTime()) > $this->expiration;
    }
}

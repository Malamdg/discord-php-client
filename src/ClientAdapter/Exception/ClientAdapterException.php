<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Exception;

use Exception;
use Throwable;

class ClientAdapterException extends Exception
{
    /**
     * Unable to function, empty credentials.
     *
     * @param array|string $param
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function missingRequiredParameter(array|string $param, ?Throwable $previous = null): static
    {
        $plural = count($param) > 1 ? 's' : '';
        is_array($param) && $param = implode("', '", $param);

        return new self(message: sprintf("Options key%s '%s' must be present and not empty.", $plural, $param), previous: $previous);
    }
}
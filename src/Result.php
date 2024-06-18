<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use JsonSerializable;
use Malamdg\DiscordPhpClient\Exception\DiscordClientException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

readonly class Result implements JsonSerializable
{
    private array $data;

    /**
     * @throws DiscordClientException
     */
    public function __construct(array|ResponseInterface $data)
    {
        try {
            if ($data instanceof ResponseInterface) {
                $data = json_decode(json: $data->getBody()->getContents(), associative: true, flags: JSON_THROW_ON_ERROR);
            }
        } catch (Throwable $e) {
            throw DiscordClientException::result($e);
        }
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string|bool
    {
        return json_encode($this->data);
    }

    /**
     * Get array copy of result data.
     *
     * @return array
     */
    public function getArrayCopy(): array
    {
        return $this->data;
    }

    /**
     * Get value in result data.
     *
     * @param string $key
     * @param $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * Get value in result data or fail.
     *
     * @param string $key
     *
     * @return mixed
     * @throws DiscordClientException
     */
    public function getOrFail(string $key): mixed
    {
        if (is_null($this->get($key))) {
            throw DiscordClientException::resultGet($key);
        }

        return $this->get($key);
    }
}
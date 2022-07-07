<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class InteractionRequest
{
    private string $method;
    private string $path;
    /**
     * @Serializer\Type("array")
     */
    private array $headers;
    /**
     * @Serializer\Type("array")
     */
    private array $body;

    public function __construct(string $method, string $path, array $headers, array $body)
    {
        $this->method  = $method;
        $this->path    = $path;
        $this->headers = $headers;
        $this->body    = $body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}

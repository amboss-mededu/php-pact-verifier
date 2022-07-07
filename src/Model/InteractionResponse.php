<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class InteractionResponse
{
    private int   $status;
    /**
     * @Serializer\Type("array")
     */
    private array $header;
    /**
     * @Serializer\Type("array")
     */
    private array $body;

    public function __construct(int $status, array $header, array $body)
    {
        $this->status = $status;
        $this->header = $header;
        $this->body   = $body;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}

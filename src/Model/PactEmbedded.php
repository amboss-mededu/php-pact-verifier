<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

class PactEmbedded
{
    private Consumer $consumer;

    public function __construct(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function getConsumer(): Consumer
    {
        return $this->consumer;
    }
}

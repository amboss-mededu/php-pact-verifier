<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class Consumer
{
    private string $name;
    /**
     * @Serializer\SerializedName("_embedded")
     */
    private ConsumerEmbedded $embedded;

    public function __construct(string $name, ConsumerEmbedded $embedded)
    {
        $this->name     = $name;
        $this->embedded = $embedded;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmbedded(): ConsumerEmbedded
    {
        return $this->embedded;
    }
}

<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class Pact
{
    /**
     * @Serializer\SerializedName("_embedded")
     */
    private PactEmbedded $embedded;

    public function __construct(PactEmbedded $embedded)
    {
        $this->embedded = $embedded;
    }

    public function getEmbedded(): PactEmbedded
    {
        return $this->embedded;
    }
}

<?php

declare(strict_types=1);

namespace Amboss\Pact\Model\Response;

use Amboss\Pact\Model\Interaction;
use Amboss\Pact\Model\Link;
use JMS\Serializer\Annotation as Serializer;

class PactResponse
{
    /**
     * @var Interaction[]
     * @Serializer\Type("array<Amboss\Pact\Model\Interaction>")
     */
    private array $interactions;
    /**
     * @var array<string,Link>
     * @Serializer\Type("array<string, Amboss\Pact\Model\Link>")
     * @Serializer\SerializedName("_links")
     */
    private array $links;

    public function __construct(array $interactions, array $links)
    {
        $this->interactions = $interactions;
        $this->links        = $links;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function getInteractions(): array
    {
        return $this->interactions;
    }
}

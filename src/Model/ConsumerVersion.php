<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class ConsumerVersion
{
    private string $number;
    /**
     * @var array<string,Link>
     * @Serializer\SerializedName("_links")
     * @Serializer\Type("array<string,Amboss\Pact\Model\Link>")
     */
    private array $links;

    public function __construct(string $number, array $links)
    {
        $this->number = $number;
        $this->links  = $links;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}

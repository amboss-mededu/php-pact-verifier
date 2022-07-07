<?php

declare(strict_types=1);

namespace Amboss\Pact\Model\Response;

use Amboss\Pact\Model\Pact;
use JMS\Serializer\Annotation as Serializer;

class LatestPactsResponse
{
    /**
     * @var Pact[]
     * @Serializer\Type("array<Amboss\Pact\Model\Pact>")
     */
    private array $pacts;

    public function __construct(array $pacts)
    {
        $this->pacts = $pacts;
    }

    public function getPacts(): array
    {
        return $this->pacts;
    }
}

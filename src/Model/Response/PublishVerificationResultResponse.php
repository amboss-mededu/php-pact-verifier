<?php

declare(strict_types=1);

namespace Amboss\Pact\Model\Response;

use Amboss\Pact\Model\Link;
use JMS\Serializer\Annotation as Serializer;

class PublishVerificationResultResponse
{
    /**
     * @var array<string,Link>
     * @Serializer\SerializedName("_links")
     * @Serializer\Type("array<string,Amboss\Pact\Model\Link>")
     */
    private array $links;
    private bool  $success;

    public function __construct(array $links, bool $success)
    {
        $this->links   = $links;
        $this->success = $success;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}

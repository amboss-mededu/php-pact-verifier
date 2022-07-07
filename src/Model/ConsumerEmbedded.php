<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

class ConsumerEmbedded
{
    private ConsumerVersion $version;

    public function __construct(ConsumerVersion $version)
    {
        $this->version = $version;
    }

    public function getVersion(): ConsumerVersion
    {
        return $this->version;
    }
}

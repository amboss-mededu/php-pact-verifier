<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

class Link
{
    private string $name;
    private string $href;

    public function __construct(string $name, string $href)
    {
        $this->name = $name;
        $this->href = $href;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHref(): string
    {
        return $this->href;
    }
}

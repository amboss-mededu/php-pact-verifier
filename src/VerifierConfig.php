<?php

declare(strict_types=1);

namespace Amboss\Pact;

class VerifierConfig
{
    private string  $providerName;
    private string  $consumerName;
    private ?string $version;

    public function __construct(string $providerName, string $consumerName, string $version = null)
    {
        $this->providerName = $providerName;
        $this->consumerName = $consumerName;
        $this->version      = $version;
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }

    public function getConsumerName(): string
    {
        return $this->consumerName;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }
}

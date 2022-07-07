<?php

declare(strict_types=1);

namespace Amboss\Pact;

class ProviderConfig
{
    private string $providerBaseUrl;
    private string $apiReadToken;
    private string $apiWriteToken;

    public function __construct(
        string $pactBrokerHost,
        string $apiReadToken,
        string $apiWriteToken
    ) {
        $this->providerBaseUrl = $pactBrokerHost;
        $this->apiReadToken    = $apiReadToken;
        $this->apiWriteToken   = $apiWriteToken;
    }

    public function getPactBrokerHost(): string
    {
        return $this->providerBaseUrl;
    }

    public function getApiReadToken(): string
    {
        return $this->apiReadToken;
    }

    public function getApiWriteToken(): string
    {
        return $this->apiWriteToken;
    }
}

<?php

declare(strict_types=1);

namespace Amboss\Pact\Model;

use JMS\Serializer\Annotation as Serializer;

class Interaction
{
    private string              $description;
    /**
     * @Serializer\SerializedName("providerState")
     */
    private string              $providerState;
    private InteractionRequest  $request;
    private InteractionResponse $response;

    public function __construct(
        string $description,
        string $providerState,
        InteractionRequest $request,
        InteractionResponse $response
    ) {
        $this->description   = $description;
        $this->providerState = $providerState;
        $this->request       = $request;
        $this->response      = $response;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProviderState(): string
    {
        return $this->providerState;
    }

    public function getRequest(): InteractionRequest
    {
        return $this->request;
    }

    public function getResponse(): InteractionResponse
    {
        return $this->response;
    }
}

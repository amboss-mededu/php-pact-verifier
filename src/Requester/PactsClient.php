<?php

declare(strict_types=1);

namespace Amboss\Pact\Requester;

use Amboss\Pact\Model\Response\LatestPactsResponse;
use Amboss\Pact\Model\Response\PactResponse;
use Amboss\Pact\Model\Response\PublishVerificationResultResponse;
use Amboss\Pact\ProviderConfig;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class PactsClient
{
    private const LATEST_PACTS_PATH_API = '/pacts/latest';

    private ProviderConfig      $providerConfig;
    private ClientInterface     $client;
    private SerializerInterface $serializer;

    public function __construct(
        ProviderConfig $providerConfig,
        ClientInterface $client = null,
        SerializerInterface $serializer = null
    ) {
        $this->providerConfig = $providerConfig;
        $this->client         = $client ?? new Client();
        $this->serializer     = $serializer ?? SerializerBuilder::create()->build();
    }

    public function getLatestPacts(): LatestPactsResponse
    {
        $response = $this->client->request('GET', $this->providerConfig->getPactBrokerHost() . self::LATEST_PACTS_PATH_API, [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $this->providerConfig->getApiReadToken(),
            ],
        ]);

        return $this->serializer->deserialize($response->getBody()->getContents(), LatestPactsResponse::class, 'json');
    }

    public function getPact(
        string $providerName,
        string $consumerName,
        string $version
    ): PactResponse {
        $response = $this->client->request('GET', $this->providerConfig->getPactBrokerHost() . '/pacts/provider/' . $providerName . '/consumer/' . $consumerName . '/version/' . $version, [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $this->providerConfig->getApiReadToken(),
            ],
        ]);

        return $this->serializer->deserialize($response->getBody()->getContents(), PactResponse::class, 'json');
    }

    public function publishVerificationResult(
        bool $success,
        string $link,
        string $buildUrl = 'http://example.org'
    ): PublishVerificationResultResponse {
        $response = $this->client->request('POST', $link, [
            RequestOptions::JSON    => [
                'success'                    => $success,
                'providerApplicationVersion' => '1.0.0',
                'buildUrl'                   => $buildUrl,
            ],
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $this->providerConfig->getApiWriteToken(),
            ],
        ]);

        return $this->serializer->deserialize($response->getBody()->getContents(), PublishVerificationResultResponse::class, 'json');
    }
}

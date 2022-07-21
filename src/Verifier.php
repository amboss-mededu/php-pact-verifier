<?php

declare(strict_types=1);

namespace Amboss\Pact;

use Amboss\Pact\Exception\ConsumerNotFound;
use Amboss\Pact\Exception\ProviderOrConsumerOrVersionNotFoundException;
use Amboss\Pact\Requester\PactsClient;
use Exception;
use GuzzleHttp\Exception\ClientException;

class Verifier
{
    private PactsClient $pactsClient;

    public function __construct(PactsClient $pactsClient)
    {
        $this->pactsClient = $pactsClient;
    }

    public function verify(VerifierConfig $verifierConfig, $callable): void
    {
        $consumerName = $verifierConfig->getConsumerName();
        $version      = $verifierConfig->getVersion();
        if ($version === null) {
            $version = $this->getLatestConsumerVersion($consumerName);
        }

        $providerName = $verifierConfig->getProviderName();

        try {
            $pactResponse = $this->pactsClient->getPact($providerName, $consumerName, $version);
        } catch (ClientException $exception) {
            if ($exception->getCode() === 404) {
                throw new ProviderOrConsumerOrVersionNotFoundException(sprintf('The combination Consumer: %s, Provider: %s and Version: %s has not been found.', $consumerName, $providerName, $version));
            }

            throw $exception;
        }

        $success = true;
        try {
            $callable($pactResponse->getInteractions());
        } catch (Exception $exception) {
            $success = false;
        }

        $this->pactsClient->publishVerificationResult(
            $success,
            $pactResponse->getLinks()['pb:publish-verification-results']->getHref()
        );
    }

    private function getLatestConsumerVersion(string $consumerName): string
    {
        $pactsResponse = $this->pactsClient->getLatestPacts();

        foreach ($pactsResponse->getPacts() as $pact) {
            $consumer = $pact->getEmbedded()->getConsumer();
            if ($consumer->getName() === $consumerName) {
                return $consumer->getEmbedded()->getVersion()->getNumber();
            }
        }

        throw new ConsumerNotFound(sprintf('Consumer %s not found', $consumerName));
    }
}

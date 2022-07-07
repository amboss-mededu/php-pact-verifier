<?php

declare(strict_types=1);

namespace Amboss\Pact;

use Amboss\Pact\Requester\PactsClient;
use Exception;
use LogicException;

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

        $pactResponse = $this->pactsClient->getPact($verifierConfig->getProviderName(), $consumerName, $version);
        $success      = true;
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

        throw new LogicException('Consumer not found');
    }
}

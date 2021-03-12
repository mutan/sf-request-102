<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Dto\NFLTeam\NFLTeamApiRequest;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SportsdataApiService
{
    private const BASE_URL = 'https://api.sportsdata.io/v3/nfl';

    private HttpClientInterface $httpClient;

    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     *
     * @return array
     */
    private function execute(string $url): array
    {
        $response = $this->httpClient->request(
            'GET',
            self::BASE_URL.$url,
            [
                'query' => [
                    'key' => $this->apiKey,
                ],
            ]
        );

        return $response->toArray();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface|DecodingExceptionInterface
     */
    public function fetchNFLTeams(): array
    {
        return $this->execute('/scores/json/Teams');
    }
}

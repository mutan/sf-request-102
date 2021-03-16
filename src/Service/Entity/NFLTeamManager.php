<?php

declare(strict_types=1);

namespace App\Service\Entity;

use App\Factory\NFLTeamFactory;
use App\Repository\NFLTeamRepository;
use App\Service\Api\SportsdataApiService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NFLTeamManager
{
    private const TEAM_MAP_CACHE_KEY = 'team_map';

    private NFLTeamRepository $repository;

    private NFLTeamFactory $factory;

    private SportsdataApiService $api;

    private EntityManagerInterface $em;

    private CacheItemPoolInterface $cachePool;

    public function __construct(
        EntityManagerInterface $em,
        CacheItemPoolInterface $cachePool,
        NFLTeamRepository $repository,
        NFLTeamFactory $factory,
        SportsdataApiService $api
    ) {
        $this->em = $em;
        $this->cachePool = $cachePool;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->api = $api;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws InvalidArgumentException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function updateTeamListByApi(): void
    {
        $data = $this->api->fetchNFLTeams();
        $teamsMap = $this->getTeamsMap();

        foreach ($data as $item) {
            if (isset($teamsMap[$item['TeamID']])) {
                $this->factory->updateEntityFromArray($teamsMap[$item['TeamID']], $item);
                $this->em->persist($teamsMap[$item['TeamID']]);
            } else {
                $NFLTeam = $this->factory->createEntityFromArray($item);
                $this->em->persist($NFLTeam);
            }
        }
        $this->em->flush();
    }

    /**
     * @throws InvalidArgumentException
     */
    private function getTeamsMap(): array
    {
        $item = $this->cachePool->getItem(self::TEAM_MAP_CACHE_KEY);

        if (!$item->isHit()) {
            $teamsMap = [];
            $teams = $this->repository->findAll();

            foreach ($teams as $team) {
                $teamsMap[$team->getTeamId()] = $team;
            }

            $item->set($teamsMap)->expiresAt(new DateTime('+1 hour'));
            $this->cachePool->save($item);
        }

        return $item->get();
    }
}

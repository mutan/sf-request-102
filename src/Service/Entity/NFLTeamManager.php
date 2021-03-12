<?php

declare(strict_types=1);

namespace App\Service\Entity;

use App\Factory\NFLTeamFactory;
use App\Repository\NFLTeamRepository;
use App\Service\Api\SportsdataApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NFLTeamManager
{
    private NFLTeamRepository $repository;

    private NFLTeamFactory $factory;

    private SportsdataApiService $api;

    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em,
        NFLTeamRepository $repository,
        NFLTeamFactory $factory,
        SportsdataApiService $api
    ) {
        $this->em = $em;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->api = $api;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function updateTeamListByApi(): void
    {
        $data = $this->api->fetchNFLTeams();
        $teamMap = $this->getTeamMap();

        foreach ($data as $item) {
            if (isset($teamMap[$item['TeamID']])) {
                $NFLTeam = $this->factory->updateEntityFromArray($teamMap[$item['TeamID']], $item);
            } else {
                $NFLTeam = $this->factory->createEntityFromArray($item);
            }

            $this->em->persist($NFLTeam);
        }
        $this->em->flush();
    }

    private function getTeamMap(): array
    {
        $teamMap = [];
        $teams = $this->repository->findAll();

        foreach ($teams as $team) {
            $teamMap[$team->getTeamId()] = $team;
        }

        return $teamMap;
    }
}

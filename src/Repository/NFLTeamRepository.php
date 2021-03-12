<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NFLTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NFLTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method NFLTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method NFLTeam[]    findAll()
 * @method NFLTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NFLTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NFLTeam::class);
    }
}

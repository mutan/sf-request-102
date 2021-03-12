<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\NFLTeam;

class NFLTeamFactory
{
    public function createEntityFromArray($data): NFLTeam
    {
        return (new NFLTeam())
            ->setKey($data['Key'])
            ->setTeamId($data['TeamID'])
            ->setCity($data['City'])
            ->setName($data['Name'])
            ->setFullName($data['FullName'])
            ->setConference($data['Conference'])
            ->setDivision($data['Division'])
            ->setOffensiveScheme($data['OffensiveScheme'])
            ->setDefensiveScheme($data['DefensiveScheme'])
            ->setHeadCoach($data['HeadCoach'])
            ->setLogoUrl($data['WikipediaLogoUrl'])
            ->setWordMarkUrl($data['WikipediaWordMarkUrl']);
    }

    public function updateEntityFromArray(NFLTeam $team, $data): NFLTeam
    {
        return $team
            ->setKey($data['Key'])
            ->setTeamId($data['TeamID'])
            ->setCity($data['City'])
            ->setName($data['Name'])
            ->setFullName($data['FullName'])
            ->setConference($data['Conference'])
            ->setDivision($data['Division'])
            ->setOffensiveScheme($data['OffensiveScheme'])
            ->setDefensiveScheme($data['DefensiveScheme'])
            ->setHeadCoach($data['HeadCoach'])
            ->setLogoUrl($data['WikipediaLogoUrl'])
            ->setWordMarkUrl($data['WikipediaWordMarkUrl']);
    }
}

<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Warehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WarehouseFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['msk-dom', 'Москва Домодедово'],
            ['msk-she', 'Москва Шереметьево'],
            ['msk-zhu', 'Москва Жуковский'],
        ];

        foreach ($data as $item) {
            $warehouse = (new Warehouse())
                ->setCode($item[0])
                ->setName($item[1])
                ->setActive(true);
            $manager->persist($warehouse);
        }

        $manager->flush();
    }
}

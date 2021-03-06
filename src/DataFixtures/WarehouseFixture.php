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
        $warehouse = new Warehouse();
        $warehouse->setCode('msk')
            ->setName('Москва Зюзино')
            ->setActive(true);

        rand(1, 10);

        $manager->persist($warehouse);

        $manager->flush();
    }
}

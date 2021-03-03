<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\Warehouse\WarehouseDto;
use App\Entity\Warehouse;

class WarehouseFactory
{
    public function createEntityFromDto(WarehouseDto $warehouse): Warehouse
    {
        return (new Warehouse())
            ->setCode($warehouse->getCode())
            ->setName($warehouse->getName())
            ->setActive($warehouse->isActive());
    }

    public function createDtoFromEntity(Warehouse $warehouse): WarehouseDto
    {
        return (new WarehouseDto())
            ->setId($warehouse->getId())
            ->setCode($warehouse->getCode())
            ->setName($warehouse->getName())
            ->setActive($warehouse->getActive());
    }
}

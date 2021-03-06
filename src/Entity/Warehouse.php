<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WarehouseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"GET", "POST"},
 *     itemOperations={"GET", "PUT"},
 *     shortName="Warehouse"
 * )
 * @ORM\Entity(repositoryClass=WarehouseRepository::class)
 * @ORM\Table(options={"comment": "Склады"})
 */
class Warehouse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Unique text code of warehouse
     *
     * @ORM\Column(type="string", length=255, unique=true, options={"comment": "Код склада"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, options={"comment": "Название склада"})
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}

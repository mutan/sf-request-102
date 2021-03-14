<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NFLTeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NFLTeamRepository::class)
 * @ORM\Table(name="nfl_team")
 */
class NFLTeam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $key;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private int $teamId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $conference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $division;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $fullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $headCoach;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private ?string $offensiveScheme;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private ?string $defensiveScheme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $logoUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $wordMarkUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    public function setTeamId(int $teamId): self
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getConference(): ?string
    {
        return $this->conference;
    }

    public function setConference(?string $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(?string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getHeadCoach(): ?string
    {
        return $this->headCoach;
    }

    public function setHeadCoach(?string $headCoach): self
    {
        $this->headCoach = $headCoach;

        return $this;
    }

    public function getOffensiveScheme(): ?string
    {
        return $this->offensiveScheme;
    }

    public function setOffensiveScheme(?string $offensiveScheme): self
    {
        $this->offensiveScheme = $offensiveScheme;

        return $this;
    }

    public function getDefensiveScheme(): ?string
    {
        return $this->defensiveScheme;
    }

    public function setDefensiveScheme(?string $defensiveScheme): self
    {
        $this->defensiveScheme = $defensiveScheme;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getWordMarkUrl(): ?string
    {
        return $this->wordMarkUrl;
    }

    public function setWordMarkUrl(?string $wordMarkUrl): self
    {
        $this->wordMarkUrl = $wordMarkUrl;

        return $this;
    }
}

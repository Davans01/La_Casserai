<?php

namespace App\Entity;

use App\Repository\SeizoenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeizoenRepository::class)
 */
class Seizoen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginddatum;

    /**
     * @ORM\Column(type="datetime")
     */
    private $einddatum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $korting;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getBeginddatum(): ?\DateTimeInterface
    {
        return $this->beginddatum;
    }

    public function setBeginddatum(\DateTimeInterface $beginddatum): self
    {
        $this->beginddatum = $beginddatum;

        return $this;
    }

    public function getEinddatum(): ?\DateTimeInterface
    {
        return $this->einddatum;
    }

    public function setEinddatum(\DateTimeInterface $einddatum): self
    {
        $this->einddatum = $einddatum;

        return $this;
    }

    public function getKorting(): ?string
    {
        return $this->korting;
    }

    public function setKorting(string $korting): self
    {
        $this->korting = $korting;

        return $this;
    }
}

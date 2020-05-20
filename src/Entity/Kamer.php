<?php

namespace App\Entity;

use App\Repository\KamerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KamerRepository::class)
 */
class Kamer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Soort::class, inversedBy="kamers")
     */
    private $soort_id;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity=Resevering::class, mappedBy="kamer_id")
     */
    private $reseverings;

    public function __construct()
    {
        $this->reseverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoortId(): ?Soort
    {
        return $this->soort_id;
    }

    public function setSoortId(?Soort $soort_id): self
    {
        $this->soort_id = $soort_id;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * @return Collection|Resevering[]
     */
    public function getReseverings(): Collection
    {
        return $this->reseverings;
    }

    public function addResevering(Resevering $resevering): self
    {
        if (!$this->reseverings->contains($resevering)) {
            $this->reseverings[] = $resevering;
            $resevering->setKamerId($this);
        }

        return $this;
    }

    public function removeResevering(Resevering $resevering): self
    {
        if ($this->reseverings->contains($resevering)) {
            $this->reseverings->removeElement($resevering);
            // set the owning side to null (unless already changed)
            if ($resevering->getKamerId() === $this) {
                $resevering->setKamerId(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\BetaalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BetaalRepository::class)
 */
class Betaal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="betaals")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $soort;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rekening;

    /**
     * @ORM\Column(type="datetime")
     */
    private $betaaldate;

    /**
     * @ORM\OneToMany(targetEntity=Resevering::class, mappedBy="betaal_lid")
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getSoort(): ?string
    {
        return $this->soort;
    }

    public function setSoort(string $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getRekening(): ?string
    {
        return $this->rekening;
    }

    public function setRekening(string $rekening): self
    {
        $this->rekening = $rekening;

        return $this;
    }

    public function getBetaaldate(): ?\DateTimeInterface
    {
        return $this->betaaldate;
    }

    public function setBetaaldate(\DateTimeInterface $betaaldate): self
    {
        $this->betaaldate = $betaaldate;

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
            $resevering->setBetaalLid($this);
        }

        return $this;
    }

    public function removeResevering(Resevering $resevering): self
    {
        if ($this->reseverings->contains($resevering)) {
            $this->reseverings->removeElement($resevering);
            // set the owning side to null (unless already changed)
            if ($resevering->getBetaalLid() === $this) {
                $resevering->setBetaalLid(null);
            }
        }

        return $this;
    }
}

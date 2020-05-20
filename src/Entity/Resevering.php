<?php

namespace App\Entity;

use App\Repository\ReseveringRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReseveringRepository::class)
 */
class Resevering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Kamer::class, inversedBy="reseverings")
     */
    private $kamer_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reseverings")
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkin_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkout_date;

    /**
     * @ORM\ManyToOne(targetEntity=Betaal::class, inversedBy="reseverings")
     */
    private $betaal_lid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $betaal_methode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKamerId(): ?Kamer
    {
        return $this->kamer_id;
    }

    public function setKamerId(?Kamer $kamer_id): self
    {
        $this->kamer_id = $kamer_id;

        return $this;
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

    public function getCheckinDate(): ?\DateTimeInterface
    {
        return $this->checkin_date;
    }

    public function setCheckinDate(\DateTimeInterface $checkin_date): self
    {
        $this->checkin_date = $checkin_date;

        return $this;
    }

    public function getCheckoutDate(): ?\DateTimeInterface
    {
        return $this->checkout_date;
    }

    public function setCheckoutDate(\DateTimeInterface $checkout_date): self
    {
        $this->checkout_date = $checkout_date;

        return $this;
    }

    public function getBetaalLid(): ?Betaal
    {
        return $this->betaal_lid;
    }

    public function setBetaalLid(?Betaal $betaal_lid): self
    {
        $this->betaal_lid = $betaal_lid;

        return $this;
    }

    public function getBetaalMethode(): ?string
    {
        return $this->betaal_methode;
    }

    public function setBetaalMethode(string $betaal_methode): self
    {
        $this->betaal_methode = $betaal_methode;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Betaal::class, mappedBy="user_id")
     */
    private $betaals;

    /**
     * @ORM\OneToMany(targetEntity=Resevering::class, mappedBy="user_id")
     */
    private $reseverings;

    public function __construct()
    {
        $this->betaals = new ArrayCollection();
        $this->reseverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Betaal[]
     */
    public function getBetaals(): Collection
    {
        return $this->betaals;
    }

    public function addBetaal(Betaal $betaal): self
    {
        if (!$this->betaals->contains($betaal)) {
            $this->betaals[] = $betaal;
            $betaal->setUserId($this);
        }

        return $this;
    }

    public function removeBetaal(Betaal $betaal): self
    {
        if ($this->betaals->contains($betaal)) {
            $this->betaals->removeElement($betaal);
            // set the owning side to null (unless already changed)
            if ($betaal->getUserId() === $this) {
                $betaal->setUserId(null);
            }
        }

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
            $resevering->setUserId($this);
        }

        return $this;
    }

    public function removeResevering(Resevering $resevering): self
    {
        if ($this->reseverings->contains($resevering)) {
            $this->reseverings->removeElement($resevering);
            // set the owning side to null (unless already changed)
            if ($resevering->getUserId() === $this) {
                $resevering->setUserId(null);
            }
        }

        return $this;
    }
    public function __toString() {
    return $this->email;
    }
}
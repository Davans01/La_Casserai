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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username_canonice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_canonical;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_login;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmation_token;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password_request;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_nr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile_nr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insertion_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

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

    public function getUsernameCanonice(): ?string
    {
        return $this->username_canonice;
    }

    public function setUsernameCanonice(?string $username_canonice): self
    {
        $this->username_canonice = $username_canonice;

        return $this;
    }

    public function getEmailCanonical(): ?string
    {
        return $this->email_canonical;
    }

    public function setEmailCanonical(?string $email_canonical): self
    {
        $this->email_canonical = $email_canonical;

        return $this;
    }

    public function getEnabled(): ?string
    {
        return $this->enabled;
    }

    public function setEnabled(?string $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function setSalt(?string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->last_login;
    }

    public function setLastLogin(?\DateTimeInterface $last_login): self
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmation_token;
    }

    public function setConfirmationToken(?string $confirmation_token): self
    {
        $this->confirmation_token = $confirmation_token;

        return $this;
    }

    public function getPasswordRequest(): ?string
    {
        return $this->password_request;
    }

    public function setPasswordRequest(?string $password_request): self
    {
        $this->password_request = $password_request;

        return $this;
    }

    public function getTelNr(): ?string
    {
        return $this->tel_nr;
    }

    public function setTelNr(?string $tel_nr): self
    {
        $this->tel_nr = $tel_nr;

        return $this;
    }

    public function getMobileNr(): ?string
    {
        return $this->mobile_nr;
    }

    public function setMobileNr(?string $mobile_nr): self
    {
        $this->mobile_nr = $mobile_nr;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getInsertionName(): ?string
    {
        return $this->insertion_name;
    }

    public function setInsertionName(?string $insertion_name): self
    {
        $this->insertion_name = $insertion_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserApiRepository;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"userid"}, message="Un utilisateur existe déjà avec cette userid")
 * @UniqueEntity(fields={"username"}, message="Un utilisateur existe déjà avec cette username")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity=LivretHeure::class, mappedBy="user_id")
     */
    private $livretHeures;

    /**
     * @ORM\OneToMany(targetEntity=Essence::class, mappedBy="user")
     */
    private $essences;

    /**
     * @ORM\OneToMany(targetEntity=EssenceGNR::class, mappedBy="user")
     */
    private $essenceGNRs;


    public function __construct()
    {
        $this->livretHeures = new ArrayCollection();
        $this->essences = new ArrayCollection();
        $this->essenceGNRs = new ArrayCollection();
    }


    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(?string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

//////////////////////////////////////////////

    public function addRoles(string $roles): self
    {
        if (!in_array($roles, $this->roles)) {
            $this->roles[] = $roles;
        }

        return $this;
    }



    public function hasRoles(string $roles): bool
    {
        return in_array($roles, $this->roles);
    }

    /**
     * @return Collection|LivretHeure[]
     */
    public function getLivretHeures(): Collection
    {
        return $this->livretHeures;
    }

    public function addLivretHeure(LivretHeure $livretHeure): self
    {
        if (!$this->livretHeures->contains($livretHeure)) {
            $this->livretHeures[] = $livretHeure;
            $livretHeure->setUserId($this);
        }

        return $this;
    }

    public function removeLivretHeure(LivretHeure $livretHeure): self
    {
        if ($this->livretHeures->removeElement($livretHeure)) {
            // set the owning side to null (unless already changed)
            if ($livretHeure->getUserId() === $this) {
                $livretHeure->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Essence[]
     */
    public function getEssences(): Collection
    {
        return $this->essences;
    }

    public function addEssence(Essence $essence): self
    {
        if (!$this->essences->contains($essence)) {
            $this->essences[] = $essence;
            $essence->setUser($this);
        }

        return $this;
    }

    public function removeEssence(Essence $essence): self
    {
        if ($this->essences->removeElement($essence)) {
            // set the owning side to null (unless already changed)
            if ($essence->getUser() === $this) {
                $essence->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return Collection|EssenceGNR[]
     */
    public function getEssenceGNRs(): Collection
    {
        return $this->essenceGNRs;
    }

    public function addEssenceGNR(EssenceGNR $essenceGNR): self
    {
        if (!$this->essenceGNRs->contains($essenceGNR)) {
            $this->essenceGNRs[] = $essenceGNR;
            $essenceGNR->setUser($this);
        }

        return $this;
    }

    public function removeEssenceGNR(EssenceGNR $essenceGNR): self
    {
        if ($this->essenceGNRs->removeElement($essenceGNR)) {
            // set the owning side to null (unless already changed)
            if ($essenceGNR->getUser() === $this) {
                $essenceGNR->setUser(null);
            }
        }

        return $this;
    }


}

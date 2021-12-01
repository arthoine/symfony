<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserApiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserApiRepository::class)
 */
class UserApi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Essence::class, mappedBy="user")
     */
   /* private $essences;*/

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameId;

    public function __construct()
    {
        $this->essences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Essence[]
     */
    /*public function getEssences(): Collection
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
    }*/

    public function getNameId(): ?string
    {
        return $this->nameId;
    }

    public function setNameId(string $nameId): self
    {
        $this->nameId = $nameId;

        return $this;
    }
}

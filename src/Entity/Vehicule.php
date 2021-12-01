<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
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
    private $namevehicule;

    /**
     * @ORM\OneToMany(targetEntity=Essence::class, mappedBy="vehicule")
     */
    private $essences;

    public function __construct()
    {
        $this->essences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamevehicule(): ?string
    {
        return $this->namevehicule;
    }

    public function setNamevehicule(string $namevehicule): self
    {
        $this->namevehicule = $namevehicule;

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
            $essence->setVehicule($this);
        }

        return $this;
    }

    public function removeEssence(Essence $essence): self
    {
        if ($this->essences->removeElement($essence)) {
            // set the owning side to null (unless already changed)
            if ($essence->getVehicule() === $this) {
                $essence->setVehicule(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->namevehicule;
    }

}

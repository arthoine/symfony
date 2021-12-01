<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Vehicule2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=Vehicule2Repository::class)
 */
class Vehicule2
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
     * @ORM\OneToMany(targetEntity=EssenceGNR::class, mappedBy="vehicule")
     */
    private $essenceGNRs;

    public function __construct()
    {
        $this->essenceGNRs = new ArrayCollection();
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
            $essenceGNR->setVehicule($this);
        }

        return $this;
    }

    public function removeEssenceGNR(EssenceGNR $essenceGNR): self
    {
        if ($this->essenceGNRs->removeElement($essenceGNR)) {
            // set the owning side to null (unless already changed)
            if ($essenceGNR->getVehicule() === $this) {
                $essenceGNR->setVehicule(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->namevehicule;
    }

}

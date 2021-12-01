<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
#[ApiResource]
class Client
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
    private $id_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Code_postal;

    /**
     * @ORM\OneToMany(targetEntity=LivretHeure::class, mappedBy="id_client")
     */
    private $livretHeures;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actif;

    public function __construct()
    {
        $this->livretHeures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?string
    {
        return $this->id_client;
    }

    public function setIdClient(string $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->Code_postal;
    }

    public function setCodePostal(string $Code_postal): self
    {
        $this->Code_postal = $Code_postal;

        return $this;
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
            $livretHeure->setIdClient($this);
        }

        return $this;
    }

    public function removeLivretHeure(LivretHeure $livretHeure): self
    {
        if ($this->livretHeures->removeElement($livretHeure)) {
            // set the owning side to null (unless already changed)
            if ($livretHeure->getIdClient() === $this) {
                $livretHeure->setIdClient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Nom ;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }


}

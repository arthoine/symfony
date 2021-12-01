<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LivretHeureRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=LivretHeureRepository::class)
 */
#[ApiResource]
class LivretHeure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="livretHeures")
     */
    private $user_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="livretHeures")
     */
    private $id_client;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    //private $ville;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $abs_maladie;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $CP;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $formation;


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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(?Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getNbreHeure(): ?int
    {
        return $this->nbre_heure;
    }

    public function setNbreHeure(int $nbre_heure): self
    {
        $this->nbre_heure = $nbre_heure;

        return $this;
    }

    /*public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }*/

    public function getAbsMaladie(): ?bool
    {
        return $this->abs_maladie;
    }

    public function setAbsMaladie(bool $abs_maladie): self
    {
        $this->abs_maladie = $abs_maladie;

        return $this;
    }

    public function getCP(): ?bool
    {
        return $this->CP;
    }

    public function setCP(bool $CP): self
    {
        $this->CP = $CP;

        return $this;
    }

    public function getFormation(): ?bool
    {
        return $this->formation;
    }

    public function setFormation(?bool $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function __toString(){
        if(is_null($this->id_client)) {
            return 'NULL';
        }
        return $this->id_client;
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Emploi
 *
 * @ORM\Table(name="emploi")
 * @ORM\Entity
 */
class Emploi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_emploi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEmploi;


    /**
     * @var int
     * @Assert\Positive(message="Entrez un nombre correct")
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_etude", type="string", length=225, nullable=false)
     */
    private $niveauEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=225, nullable=false)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=225, nullable=false)
     */
    private $sexe;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabilite", type="string", length=225, nullable=false)
     */
    private $responsabilite;

    /**
     * @var int
     *@Assert\Positive(message="Entrez un nombre correct")
     * @ORM\Column(name="ageMin", type="integer", nullable=false)
     */
    private $agemin;

    /**
     * @var int
     *@Assert\Positive(message="Entrez un nombre correct")
     * @ORM\Column(name="ageMax", type="integer", nullable=false)
     */
    private $agemax;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_emploi", type="string", length=255, nullable=false)
     */
    private $nomEmploi;

    public function getIdEmploi(): ?int
    {
        return $this->idEmploi;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getNiveauEtude(): ?string
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(string $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getResponsabilite(): ?string
    {
        return $this->responsabilite;
    }

    public function setResponsabilite(string $responsabilite): self
    {
        $this->responsabilite = $responsabilite;

        return $this;
    }

    public function getAgemin(): ?int
    {
        return $this->agemin;
    }

    public function setAgemin(int $agemin): self
    {
        $this->agemin = $agemin;

        return $this;
    }

    public function getAgemax(): ?int
    {
        return $this->agemax;
    }

    public function setAgemax(int $agemax): self
    {
        $this->agemax = $agemax;

        return $this;
    }

    public function getNomEmploi(): ?string
    {
        return $this->nomEmploi;
    }

    public function setNomEmploi(string $nomEmploi): self
    {
        $this->nomEmploi = $nomEmploi;

        return $this;
    }


}

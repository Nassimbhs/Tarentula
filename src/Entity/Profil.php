<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $competence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dernierDiplome;

    /**
     * @ORM\Column(type="date")
     */
    private $dateObtention;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dernierEmploi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domaineActivite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionPoste;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauLangue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descPersonnelle;

    /**
     * One Personne has One Profil.
     * @ORM\OneToOne(targetEntity="App\Entity\Personne",inversedBy="profil",cascade={"persist","remove"})
     */
    private $personne;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id): ?self
    {
        if($id)
        {
            $this->id=$id;
        }
        else
        {$this->id=-1;}

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(string $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getDernierDiplome(): ?string
    {
        return $this->dernierDiplome;
    }

    public function setDernierDiplome(string $dernierDiplome): self
    {
        $this->dernierDiplome = $dernierDiplome;

        return $this;
    }


    public function setPersonne(personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->dateObtention;
    }

    public function setDateObtention(\DateTimeInterface $dateObtention): self
    {
        $this->dateObtention = $dateObtention;

        return $this;
    }

    public function getDernierEmploi(): ?string
    {
        return $this->dernierEmploi;
    }

    public function setDernierEmploi(string $dernierEmploi): self
    {
        $this->dernierEmploi = $dernierEmploi;

        return $this;
    }

    public function getDomaineActivite(): ?string
    {
        return $this->domaineActivite;
    }

    public function setDomaineActivite(string $domaineActivite): self
    {
        $this->domaineActivite = $domaineActivite;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getDescriptionPoste(): ?string
    {
        return $this->descriptionPoste;
    }

    public function setDescriptionPoste(string $descriptionPoste): self
    {
        $this->descriptionPoste = $descriptionPoste;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getNiveauLangue(): ?string
    {
        return $this->niveauLangue;
    }

    public function setNiveauLangue(string $niveauLangue): self
    {
        $this->niveauLangue = $niveauLangue;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDescPersonnelle(): ?string
    {
        return $this->descPersonnelle;
    }

    public function setDescPersonnelle(string $descPersonnelle): self
    {
        $this->descPersonnelle = $descPersonnelle;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }
}

<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlankValidator;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
      * @Assert\NotBlank(message="Remplir ce champs!!!")
      * @Assert\Length(
      * min = 2,
      * max = 30,
      * minMessage = "la longueur de la chaine doit etre superieure à 2 caractères !",
      * maxMessage =" Vous depassez la longueur maximale (10 caractères) !"
      * )
      * @ORM\Column(type="string", length=30, nullable=true)
      */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $organisateur;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=TypeEvenement::class, inversedBy="evenements")
     */
    private $type;
    /**
     * @ORM\Column(type="integer", length=30, nullable=true)
     */
    private $note;
    /**
     * @ORM\Column(type="integer", length=30, nullable=false)
     */
    private $totalnote;
    /**
     * @ORM\Column(type="integer", length=30, nullable=false)
     */
    private $attribution;
    /**
     * @ORM\Column(type="integer", length=30, nullable=false)
     */
    private $compteur;

    /**
     * @return mixed
     */
    public function getCompteur()
    {
        return $this->compteur;
    }

    /**
     * @param mixed $compteur
     */
    public function setCompteur($compteur): void
    {
        $this->compteur = $compteur;
    }


    /**
     * @return mixed
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * @param mixed $attribution
     */
    public function setAttribution($attribution): void
    {
        $this->attribution = $attribution;
    }



    public function getTotalnote(): ?int
    {
        return $this->totalnote;
    }


    public function setTotalnote(int $totalnote): self
    {
        $this->totalnote = $totalnote;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note): void
    {
        $this->note = $note;
    }


    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $image;


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image): void
    {
        $this->image = $image;
    }





    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->organisateur;
    }

    public function setOrganisateur(string $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

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

    public function getType(): ?TypeEvenement
    {
        return $this->type;
    }

    public function setType(?TypeEvenement $type): self
    {
        $this->type = $type;

        return $this;
    }



}

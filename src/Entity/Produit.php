<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Remplir ce champs !")
     * @Assert\Length(
     * min = 2,
     * max = 255,
     * minMessage = "la longueur de la chaine doit être supèrieur à 2 caractères !",
     * maxMessage = "Vous dépassez la longeur maximale de la chaîne (255 caractères) !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="Remplir ce champs !")
     *
     * @Assert\Length(
     * min = 20,
     * max = 2000,
     * minMessage = "la longueur de la chaine doit être supèrieur à 20 caractères !",
     * maxMessage = "Vous dépassez la longeur maximale 2000 caractères!"
     * )
     * @ORM\Column(type="string", length=2000)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Remplir ce champs !")
     * @Assert\Positive(message="Le prix doit être positive !")
     * @Assert\GreaterThan(
     *     value = 0)
     *     (message="Le prix doit être supèrieur à zéro !")
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="Remplir ce champs !")
     * @ORM\Column(type="string", length=255)
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image4;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFournisseur(): ?string
    {
        return $this->fournisseur;
    }

    public function setFournisseur(string $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage1()
    {
        return $this->image1;
    }

    public function setImage1($image1)
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3()
    {
        return $this->image3;
    }

    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4()
    {
        return $this->image4;
    }

    public function setImage4($image4)
    {
        $this->image4 = $image4;

        return $this;
    }

}
<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
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
    private $nom_panier;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_produits;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPanier(): ?string
    {
        return $this->nom_panier;
    }

    public function setNomPanier(string $nom_panier): self
    {
        $this->nom_panier = $nom_panier;

        return $this;
    }

    public function getQuantiteProduits(): ?int
    {
        return $this->quantite_produits;
    }

    public function setQuantiteProduits(int $quantite_produits): self
    {
        $this->quantite_produits = $quantite_produits;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonctionPrincipale
 *
 * @ORM\Table(name="fonction_principale")
 * @ORM\Entity
 */
class FonctionPrincipale
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fonction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFonction;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fonction", type="string", length=225, nullable=false)
     */
    private $nomFonction;

    public function getIdFonction(): ?int
    {
        return $this->idFonction;
    }

    public function getNomFonction(): ?string
    {
        return $this->nomFonction;
    }

    public function setNomFonction(string $nomFonction): self
    {
        $this->nomFonction = $nomFonction;

        return $this;
    }


}

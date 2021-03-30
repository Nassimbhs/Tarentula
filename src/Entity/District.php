<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * District
 *
 * @ORM\Table(name="district")
 * @ORM\Entity
 */
class District
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_district", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDistrict;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_district", type="string", length=225, nullable=false)
     */
    private $nomDistrict;

    public function getIdDistrict(): ?int
    {
        return $this->idDistrict;
    }

    public function getNomDistrict(): ?string
    {
        return $this->nomDistrict;
    }

    public function setNomDistrict(string $nomDistrict): self
    {
        $this->nomDistrict = $nomDistrict;

        return $this;
    }


}

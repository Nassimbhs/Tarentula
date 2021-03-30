<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Please enter a valid email address.")
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     * @Assert\Positive(message="This value should be positive.")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $adresse;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     * @Assert\EqualTo("today")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $formeJuridique;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillerz remplir ce champ")
     */
    private $capitalSociale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->formeJuridique;
    }

    public function setFormeJuridique(string $formeJuridique): self
    {
        $this->formeJuridique = $formeJuridique;

        return $this;
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

    public function getCapitalSociale(): ?int
    {
        return $this->capitalSociale;
    }

    public function setCapitalSociale(int $capitalSociale): self
    {
        $this->capitalSociale = $capitalSociale;

        return $this;
    }
}

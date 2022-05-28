<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string')]
    private $type;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'integer')]
    private $surface;

    #[ORM\Column(type: 'string', length: 2)]
    private $carrez;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $est_vendu;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'biens')]
    #[ORM\JoinColumn(nullable: false)]
    private $responsable;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getCarrez(): string
    {
        return $this->carrez;
    }

    public function setCarrez(string $carrez): self
    {
        $this->carrez = $carrez;

        return $this;
    }

    public function isEstVendu(): ?bool
    {
        return $this->est_vendu;
    }

    public function setEstVendu(bool $est_vendu): self
    {
        $this->est_vendu = $est_vendu;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getResponsable(): ?user
    {
        return $this->responsable;
    }

    public function setResponsable(?user $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }
}

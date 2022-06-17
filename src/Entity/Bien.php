<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    const TYPES = ['location', 'vente'];
    const TYPES_BATI = ['maison', 'appartement'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string')]
    #[Assert\Choice(choices: Bien::TYPES, message: "Type d'offre invalide.")]
    private $type;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    #[Assert\LessThan(99999999)]
    private $prix;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    #[Assert\LessThan(99999999)]
    private $surface;

    #[ORM\Column(type: 'string', length: 2)]
    private $carrez;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $est_vendu;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $responsable;

    #[ORM\Column(type: 'datetime', options: ['default' => "CURRENT_TIMESTAMP"])]
    private $date_creation;

    #[ORM\Column(type: 'datetime', options: ['default' => "CURRENT_TIMESTAMP"])]
    private $date_modification;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: PhotoBien::class)]
    private $photoBiens;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Choice(choices: Bien::TYPES_BATI, message: "Type de bâti invalide.")]
    private $typeBien;

    public function __construct()
    {
        $this->photoBiens = new ArrayCollection();
    }

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    /**
     * @return Collection<int, PhotoBien>
     */
    public function getPhotoBiens(): Collection
    {
        return $this->photoBiens;
    }

    public function addPhotoBien(PhotoBien $photoBien): self
    {
        if (!$this->photoBiens->contains($photoBien)) {
            $this->photoBiens[] = $photoBien;
            $photoBien->setBien($this);
        }

        return $this;
    }

    public function removePhotoBien(PhotoBien $photoBien): self
    {
        if ($this->photoBiens->removeElement($photoBien)) {
            // set the owning side to null (unless already changed)
            if ($photoBien->getBien() === $this) {
                $photoBien->setBien(null);
            }
        }

        return $this;
    }

    public function getTypeBien(): ?string
    {
        return $this->typeBien;
    }

    public function setTypeBien(?string $typeBien): self
    {
        $this->typeBien = $typeBien;

        return $this;
    }
}

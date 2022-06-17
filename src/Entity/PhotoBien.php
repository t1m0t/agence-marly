<?php

namespace App\Entity;

use App\Repository\PhotoBienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoBienRepository::class)]
class PhotoBien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $fileName;

    #[ORM\ManyToOne(targetEntity: Bien::class, inversedBy: 'photoBiens')]
    private $bien;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $estPrincipale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getBien(): ?Bien
    {
        return $this->bien;
    }

    public function setBien(?Bien $bien): self
    {
        $this->bien = $bien;

        return $this;
    }

    public function isEstPrincipale(): ?bool
    {
        return $this->estPrincipale;
    }

    public function setEstPrincipale(?bool $estPrincipale): self
    {
        $this->estPrincipale = $estPrincipale;

        return $this;
    }
}

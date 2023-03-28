<?php

namespace App\Entity;

use App\Repository\AcategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AcategorieRepository::class)]
class Acategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'acategories')]
    private ?Rproduits $Nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?Rproduits
    {
        return $this->Nom;
    }

    public function setNom(?Rproduits $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }
}

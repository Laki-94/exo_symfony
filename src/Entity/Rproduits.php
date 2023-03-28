<?php

namespace App\Entity;

use App\Repository\RproduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RproduitsRepository::class)]
class Rproduits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Prix = null;

    #[ORM\OneToMany(mappedBy: 'Nom', targetEntity: Acategorie::class)]
    private Collection $acategories;

    public function __construct()
    {
        $this->acategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function __toString()
    {
        return $this->Nom;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Acategorie>
     */
    public function getAcategories(): Collection
    {
        return $this->acategories;
    }

    public function addAcategory(Acategorie $acategory): self
    {
        if (!$this->acategories->contains($acategory)) {
            $this->acategories->add($acategory);
            $acategory->setNom($this);
        }

        return $this;
    }

    public function removeAcategory(Acategorie $acategory): self
    {
        if ($this->acategories->removeElement($acategory)) {
            // set the owning side to null (unless already changed)
            if ($acategory->getNom() === $this) {
                $acategory->setNom(null);
            }
        }

        return $this;
    }
}

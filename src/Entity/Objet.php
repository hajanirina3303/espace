<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjetRepository::class)
 */
class Objet
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
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity=Rubrique::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rubrique", referencedColumnName="RefRubrique")
     * })
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity=DonObjet::class, inversedBy="objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $don;

    /**
     * @ORM\OneToMany(targetEntity=SortieObjet::class, mappedBy="objet")
     */
    private $sortieObjets;

    public function __construct()
    {
        $this->sortieObjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    public function getDon(): ?DonObjet
    {
        return $this->don;
    }

    public function setDon(?DonObjet $don): self
    {
        $this->don = $don;

        return $this;
    }

    /**
     * @return Collection|SortieObjet[]
     */
    public function getSortieObjets(): Collection
    {
        return $this->sortieObjets;
    }

    public function addSortieObjet(SortieObjet $sortieObjet): self
    {
        if (!$this->sortieObjets->contains($sortieObjet)) {
            $this->sortieObjets[] = $sortieObjet;
            $sortieObjet->setObjet($this);
        }

        return $this;
    }

    public function removeSortieObjet(SortieObjet $sortieObjet): self
    {
        if ($this->sortieObjets->removeElement($sortieObjet)) {
            // set the owning side to null (unless already changed)
            if ($sortieObjet->getObjet() === $this) {
                $sortieObjet->setObjet(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->description . " ";
    }

}

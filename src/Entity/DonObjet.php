<?php

namespace App\Entity;

use App\Repository\DonObjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonObjetRepository::class)
 */
class DonObjet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateObjet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDonnateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="don", orphanRemoval=true)
     */
    private $objets;

    public function __construct()
    {
        $this->objets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateObjet(): ?\DateTimeInterface
    {
        return $this->dateObjet;
    }

    public function setDateObjet(\DateTimeInterface $dateObjet): self
    {
        $this->dateObjet = $dateObjet;

        return $this;
    }

    public function getNomDonnateur(): ?string
    {
        return $this->nomDonnateur;
    }

    public function setNomDonnateur(string $nomDonnateur): self
    {
        $this->nomDonnateur = $nomDonnateur;

        return $this;
    }

    public function getNumeroPhone(): ?string
    {
        return $this->numeroPhone;
    }

    public function setNumeroPhone(string $numeroPhone): self
    {
        $this->numeroPhone = $numeroPhone;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return Collection|Objet[]
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->setDon($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getDon() === $this) {
                $objet->setDon(null);
            }
        }

        return $this;
    }
}

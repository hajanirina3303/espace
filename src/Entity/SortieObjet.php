<?php

namespace App\Entity;

use App\Repository\SortieObjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortieObjetRepository::class)
 */
class SortieObjet
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
    private $date_sortie;

    /**
     * @ORM\Column(type="integer")
     */
    private $unite_objet;

    /**
     * @ORM\ManyToOne(targetEntity=Objet::class, inversedBy="sortieObjets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getUniteObjet(): ?int
    {
        return $this->unite_objet;
    }

    public function setUniteObjet(int $unite_objet): self
    {
        $this->unite_objet = $unite_objet;

        return $this;
    }

    public function getObjet(): ?Objet
    {
        return $this->objet;
    }

    public function setObjet(?Objet $objet): self
    {
        $this->objet = $objet;

        return $this;
    }
}

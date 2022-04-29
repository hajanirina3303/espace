<?php

namespace App\Entity;

use App\Repository\BilanObjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BilanObjetRepository::class)
 */
class BilanObjet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=DonObjet::class)
     */
    private $id_Don_Objet;

    /**
     * @ORM\ManyToOne(targetEntity=SortieObjet::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Sortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDonObjet(): ?DonObjet
    {
        return $this->id_Don_Objet;
    }

    public function setIdDonObjet(?DonObjet $id_Don_Objet): self
    {
        $this->id_Don_Objet = $id_Don_Objet;

        return $this;
    }

    public function getIdSortie(): ?SortieObjet
    {
        return $this->id_Sortie;
    }

    public function setIdSortie(?SortieObjet $id_Sortie): self
    {
        $this->id_Sortie = $id_Sortie;

        return $this;
    }
    
}

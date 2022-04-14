<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette", indexes={@ORM\Index(name="idRecette", columns={"idRecette"})})
 * @ORM\Entity
 */
class Recette
{
    /**
     * @var \App\Entity\Mouvement
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Mouvement", inversedBy="recette")
     * @ORM\JoinColumn(nullable=true,name="idrecette", referencedColumnName="idMouvement")
     */
    private $idrecette;
    /** 
     * @ORM\OneToOne(targetEntity=Don::class, mappedBy="iddon", cascade={"persist", "remove"})    
     **/
    private $don;
    

    public function getIdrecette(): ?Mouvement
    {
        return $this->idrecette;
    }

    public function setIdrecette(?Mouvement $idrecette): self
    {
        $this->idrecette = $idrecette;

        return $this;
    }

/**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->idrecette;
    }

    /**
     * Get the value of don
     */ 
    public function getDon()
    {
        return $this->don;
    }

    /**
     * Set the value of don
     *
     * @return  self
     */ 
    public function setDon($don)
    {
        $this->don = $don;

        return $this;
    }
}

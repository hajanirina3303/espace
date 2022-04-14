<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bilan
 * @ORM\Entity
 */
class Bilan 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /* 
     *     @ORM\Column(name="libelle", type="integer", nullable=false)
    */
    public $libelle;
    private $type;
    private $ttype;
    private $montant;

    

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of ttype
     */ 
    public function getTtype()
    {
        return $this->ttype;
    }

    /**
     * Set the value of ttype
     *
     * @return  self
     */ 
    public function setTtype($ttype)
    {
        $this->ttype = $ttype;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get /*
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set /*
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

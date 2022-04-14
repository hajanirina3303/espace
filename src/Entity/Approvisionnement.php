<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Approvisionnement
 *
 * @ORM\Table(name="approvisionnement", indexes={@ORM\Index(name="idApprovisionnement", columns={"idApprovisionnement"})})
 * @ORM\Entity
 */
class Approvisionnement
{
    /**
     * @var \App\Entity\Recette
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idApprovisionnement", referencedColumnName="idrecette")
     * })
     */
    private $idapprovisionnement;



    /**
     * Get the value of idapprovisionnement
     *
     * @return  \App\Entity\Recette
     */ 
    public function getIdapprovisionnement()
    {
        return $this->idapprovisionnement;
    }

    /**
     * Set the value of idapprovisionnement
     *
     * @param  \App\Entity\Recette  $idapprovisionnement
     *
     * @return  self
     */ 
    public function setIdapprovisionnement(\App\Entity\Recette $idapprovisionnement)
    {
        $this->idapprovisionnement = $idapprovisionnement;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique")
 * @ORM\Entity
 */
class Rubrique
{
    /**
     * @var string
     *
     * @ORM\Column(name="RefRubrique", type="string", length=20, nullable=false)
     * @ORM\Id
     */
    private $refrubrique;

    /**
     * @var string
     *
     * @ORM\Column(name="LibelleRubrique", type="string", length=255, nullable=false)
     */
    private $libellerubrique;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Type;

    public function getRefrubrique(): ?string
    {
        return $this->refrubrique;
    }

      /**
     * Set the value of refrubrique
     *
     * @param  string  $refrubrique
     *
     * @return  self
     */ 
    public function setRefrubrique(string $refrubrique)
    {
        $this->refrubrique = $refrubrique;

        return $this;
    }

    public function getLibellerubrique(): ?string
    {
        return $this->libellerubrique;
    }

    public function setLibellerubrique(string $libellerubrique): self
    {
        $this->libellerubrique = $libellerubrique;

        return $this;
    }

  

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->refrubrique." ".$this->libellerubrique;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

}

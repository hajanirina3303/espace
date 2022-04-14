<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depense
 *
 * @ORM\Table(name="depense", indexes={@ORM\Index(name="idDepense", columns={"idDepense"})})
 * @ORM\Entity
 */
class Depense
{
    /**
     * @var \App\Entity\Mouvement
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Mouvement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDepense", referencedColumnName="idMouvement")
     * })
     */
    private $iddepense;

    public function getIddepense(): ?Mouvement
    {
        return $this->iddepense;
    }

    public function setIddepense(?Mouvement $iddepense): self
    {
        $this->iddepense = $iddepense;

        return $this;
    }


}

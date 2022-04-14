<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don", indexes={@ORM\Index(name="idDon", columns={"idDon"})})
 * @ORM\Entity
 */
class Don
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomDonnateur", type="string", length=255, nullable=false)
     */
    private $nomdonnateur;

    /**
     * @var \App\Entity\Recette
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Recette", inversedBy="don")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDon", referencedColumnName="idrecette")
     * })
     */
    private $iddon;

    public function getNomdonnateur(): ?string
    {
        return $this->nomdonnateur;
    }

    public function setNomdonnateur(string $nomdonnateur): self
    {
        $this->nomdonnateur = $nomdonnateur;

        return $this;
    }

    public function getIddon(): ?Recette
    {
        return $this->iddon;
    }

    public function setIddon(?Recette $iddon): self
    {
        $this->iddon = $iddon;

        return $this;
    }


}

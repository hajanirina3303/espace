<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Mouvement
 *
 * @ORM\Table(name="mouvement", indexes={@ORM\Index(name="piece_id", columns={"piece_id"}), @ORM\Index(name="rubrique_ref", columns={"rubrique_ref"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"piece"},message="Piece doit Etre Unique par Mouvement") 
 */
class Mouvement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMouvement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmouvement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMouvement", type="date", nullable=false)
     */
    private $datemouvement;

    /**
     * @var float
     *
     * @ORM\Column(name="Montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="La description est obligatoire")
     */
    private $description;

    /**
     * @var \App\Entity\Piece
     *
     * @ORM\ManyToOne(targetEntity="Piece")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="piece_id", referencedColumnName="idPiece")
     * })
     */
    private $piece;

    /**
     * @var \App\Entity\Rubrique
     *
     * @ORM\ManyToOne(targetEntity="Rubrique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rubrique_ref", referencedColumnName="RefRubrique")
     * })
     */
    private $rubriqueRef;

    /**
     * @ORM\OneToOne(targetEntity=Recette::class, mappedBy="idrecette", cascade={"persist", "remove"})
     */
    private $recette;

    public function getIdmouvement(): ?int
    {
        return $this->idmouvement;
    }

    public function getDatemouvement(): ?\DateTimeInterface
    {
        return $this->datemouvement;
    }

    public function setDatemouvement(\DateTimeInterface $datemouvement): self
    {
        $this->datemouvement = $datemouvement;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getRubriqueRef(): ?Rubrique
    {
        return $this->rubriqueRef;
    }

    public function setRubriqueRef(?Rubrique $rubriqueRef): self
    {
        $this->rubriqueRef = $rubriqueRef;

        return $this;
    }

/**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->datemouvement->format("d/m/Y") . " " . $this->description . " " . $this->montant;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(Recette $recette): self
    {
        // set the owning side of the relation if necessary
        if ($recette->getIdrecette() !== $this) {
            $recette->setIdrecette($this);
        }

        $this->recette = $recette;

        return $this;
    }

}

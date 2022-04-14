<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Piece
 *
 * @ORM\Table(name="piece")
 * @ORM\Entity
 * @UniqueEntity(fields={"idpiece"},message="Piece doit Etre Unique par Mouvement") 
 */
class Piece
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPiece", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * 
     */
    private $idpiece;

    /**
     * @var string
     *
     * @ORM\Column(name="libellePiece", type="text", length=65535, nullable=false)
     */
    private $libellepiece;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePiece", type="date", nullable=false)
     */
    private $datepiece;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroPiece;

    public function getIdpiece(): ?int
    {
        return $this->idpiece;
    }

    public function getLibellepiece(): ?string
    {
        return $this->libellepiece;
    }

    public function setLibellepiece(string $libellepiece): self
    {
        $this->libellepiece = $libellepiece;

        return $this;
    }

    public function getDatepiece(): ?\DateTimeInterface
    {
        return $this->datepiece;
    }

    public function setDatepiece(\DateTimeInterface $datepiece): self
    {
        $this->datepiece = $datepiece;

        return $this;
    }

    /**
     * Set the value of idpiece
     *
     * @param  int  $idpiece
     *
     * @return  self
     */ 
    public function setIdpiece(int $idpiece)
    {
        $this->idpiece = $idpiece;

        return $this;
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->idpiece." ".$this->libellepiece;
    }

    public function getNumeroPiece(): ?int
    {
        return $this->numeroPiece;
    }

    public function setNumeroPiece(int $numeroPiece): self
    {
        $this->numeroPiece = $numeroPiece;

        return $this;
    }

}

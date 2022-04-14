<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Releve
 *
 * @ORM\Table(name="releve")
 * @ORM\Entity
 */
class Releve
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreleve", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreleve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReleve", type="date", nullable=false)
     */
    private $datereleve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var  \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var float
     *
     * @ORM\Column(name="montantDebut", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantdebut;

    /**
     * @var float
     *
     * @ORM\Column(name="montantFin", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantfin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    public function getIdreleve(): ?int
    {
        return $this->idreleve;
    }

    public function getDatereleve(): ?\DateTimeInterface
    {
        return $this->datereleve;
    }

    public function setDatereleve(\DateTimeInterface $datereleve): self
    {
        $this->datereleve = $datereleve;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTime
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTime $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getMontantdebut(): ?float
    {
        return $this->montantdebut;
    }

    public function setMontantdebut(float $montantdebut): self
    {
        $this->montantdebut = $montantdebut;

        return $this;
    }

    public function getMontantfin(): ?float
    {
        return $this->montantfin;
    }

    public function setMontantfin(float $montantfin): self
    {
        $this->montantfin = $montantfin;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }


}

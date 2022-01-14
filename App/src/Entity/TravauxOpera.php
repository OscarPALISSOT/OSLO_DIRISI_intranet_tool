<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravauxOpera
 *
 * @ORM\Entity(repositoryClass="App\Repository\TravauxOperaRepository")
 * @ORM\Table(name="travaux_opera", uniqueConstraints={@ORM\UniqueConstraint(name="Travaux_Opera_Opera_AK", columns={"id_opera"})})
 */
class TravauxOpera
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_travaux_opera", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTravauxOpera;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_travaux_opera", type="date", nullable=false)
     */
    private $dateTravauxOpera;

    /**
     * @var int
     *
     * @ORM\Column(name="debit_fin_travaux_opera", type="integer", nullable=false)
     */
    private $debitFinTravauxOpera;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_travaux_opera", type="string", length=50, nullable=false)
     */
    private $etatTravauxOpera;

    /**
     * @var \Opera
     *
     * @ORM\ManyToOne(targetEntity="Opera")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_opera", referencedColumnName="id_opera")
     * })
     */
    private $idOpera;

    public function getIdTravauxOpera(): ?int
    {
        return $this->idTravauxOpera;
    }

    public function getDateTravauxOpera(): ?\DateTimeInterface
    {
        return $this->dateTravauxOpera;
    }

    public function setDateTravauxOpera(\DateTimeInterface $dateTravauxOpera): self
    {
        $this->dateTravauxOpera = $dateTravauxOpera;

        return $this;
    }

    public function getDebitFinTravauxOpera(): ?int
    {
        return $this->debitFinTravauxOpera;
    }

    public function setDebitFinTravauxOpera(int $debitFinTravauxOpera): self
    {
        $this->debitFinTravauxOpera = $debitFinTravauxOpera;

        return $this;
    }

    public function getEtatTravauxOpera(): ?string
    {
        return $this->etatTravauxOpera;
    }

    public function setEtatTravauxOpera(string $etatTravauxOpera): self
    {
        $this->etatTravauxOpera = $etatTravauxOpera;

        return $this;
    }

    public function getIdOpera(): ?Opera
    {
        return $this->idOpera;
    }

    public function setIdOpera(?Opera $idOpera): self
    {
        $this->idOpera = $idOpera;

        return $this;
    }


}

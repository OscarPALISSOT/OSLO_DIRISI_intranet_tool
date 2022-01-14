<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opera
 *
 * @ORM\Entity(repositoryClass="App\Repository\OperaRepository")
 * @ORM\Table(name="opera", indexes={@ORM\Index(name="Opera_quartiers_FK", columns={"id_quartier"})})
 */
class Opera
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_opera", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOpera;

    /**
     * @var string
     *
     * @ORM\Column(name="id_access", type="string", length=50, nullable=false)
     */
    private $idAccess;

    /**
     * @var string
     *
     * @ORM\Column(name="type_opera", type="string", length=50, nullable=false)
     */
    private $typeOpera;

    /**
     * @var int
     *
     * @ORM\Column(name="debit_opera", type="integer", nullable=false)
     */
    private $debitOpera;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_opera", type="string", length=50, nullable=false)
     */
    private $etatOpera;

    /**
     * @var \Quartiers
     *
     * @ORM\ManyToOne(targetEntity="Quartiers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quartier", referencedColumnName="id_quartier")
     * })
     */
    private $idQuartier;

    public function getIdOpera(): ?int
    {
        return $this->idOpera;
    }

    public function getIdAccess(): ?string
    {
        return $this->idAccess;
    }

    public function setIdAccess(string $idAccess): self
    {
        $this->idAccess = $idAccess;

        return $this;
    }

    public function getTypeOpera(): ?string
    {
        return $this->typeOpera;
    }

    public function setTypeOpera(string $typeOpera): self
    {
        $this->typeOpera = $typeOpera;

        return $this;
    }

    public function getDebitOpera(): ?int
    {
        return $this->debitOpera;
    }

    public function setDebitOpera(int $debitOpera): self
    {
        $this->debitOpera = $debitOpera;

        return $this;
    }

    public function getEtatOpera(): ?string
    {
        return $this->etatOpera;
    }

    public function setEtatOpera(string $etatOpera): self
    {
        $this->etatOpera = $etatOpera;

        return $this;
    }

    public function getIdQuartier(): ?Quartiers
    {
        return $this->idQuartier;
    }

    public function setIdQuartier(?Quartiers $idQuartier): self
    {
        $this->idQuartier = $idQuartier;

        return $this;
    }


}

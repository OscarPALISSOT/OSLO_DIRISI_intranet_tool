<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BasesDeDefense
 *
 * @ORM\Table(name="bases_de_defense", indexes={@ORM\Index(name="Bases_de_defense_rfz_FK", columns={"id_rfz"})})
 * @ORM\Entity(repositoryClass="App\Repository\BasesDeDefenseRepository")
 */
class BasesDeDefense
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_base_defense", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBaseDefense;

    /**
     * @var string
     *
     * @ORM\Column(name="base_defense", type="string", length=50, nullable=false)
     */
    private $baseDefense;

    /**
     * @var \Rfz
     *
     * @ORM\ManyToOne(targetEntity="Rfz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rfz", referencedColumnName="id_rfz")
     * })
     */
    private $idRfz;

    public function getIdBaseDefense(): ?int
    {
        return $this->idBaseDefense;
    }

    public function getBaseDefense(): ?string
    {
        return $this->baseDefense;
    }

    public function setBaseDefense(string $baseDefense): self
    {
        $this->baseDefense = $baseDefense;

        return $this;
    }

    public function getIdRfz(): ?Rfz
    {
        return $this->idRfz;
    }

    public function setIdRfz(?Rfz $idRfz): self
    {
        $this->idRfz = $idRfz;

        return $this;
    }


}

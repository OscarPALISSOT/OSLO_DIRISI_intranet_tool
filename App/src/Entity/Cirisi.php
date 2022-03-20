<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cirisi
 *
 * @ORM\Table(name="cirisi", uniqueConstraints={@ORM\UniqueConstraint(name="Cirisi_Bases_de_defense_AK", columns={"id_base_defense"})})
 * @ORM\Entity(repositoryClass="App\Repository\CirisiRepository")
 */
class Cirisi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cirisi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="cirisi", type="string", length=50, nullable=false)
     */
    private $cirisi;

    /**
     * @var \BasesDeDefense
     *
     * @ORM\ManyToOne(targetEntity="BasesDeDefense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_base_defense", referencedColumnName="id_base_defense")
     * })
     */
    private $idBaseDefense;

    public function getIdCirisi(): ?int
    {
        return $this->idCirisi;
    }

    public function getCirisi(): ?string
    {
        return $this->cirisi;
    }

    public function setCirisi(string $cirisi): self
    {
        $this->cirisi = $cirisi;

        return $this;
    }

    public function getIdBaseDefense(): ?BasesDeDefense
    {
        return $this->idBaseDefense;
    }

    public function setIdBaseDefense(?BasesDeDefense $idBaseDefense): self
    {
        $this->idBaseDefense = $idBaseDefense;

        return $this;
    }


}

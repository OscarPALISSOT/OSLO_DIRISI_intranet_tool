<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sigle
 *
 * @ORM\Table(name="sigle")
 * @ORM\Entity(repositoryClass="App\Repository\SigleRepository")
 */
class Sigle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_sigle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSigle;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_sigle", type="string", length=50, nullable=false)
     */
    private $intituleSigle;

    /**
     * @var string
     *
     * @ORM\Column(name="sigle", type="string", length=50, nullable=false)
     */
    private $sigle;

    public function getIdSigle(): ?int
    {
        return $this->idSigle;
    }

    public function getIntituleSigle(): ?string
    {
        return $this->intituleSigle;
    }

    public function setIntituleSigle(string $intituleSigle): self
    {
        $this->intituleSigle = $intituleSigle;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSigle();
    }

}

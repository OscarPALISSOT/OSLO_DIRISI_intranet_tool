<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrandsComptes
 *
 * @ORM\Table(name="grands_comptes")
 * @ORM\Entity(repositoryClass="App\Repository\GrandsComptesRepository")
 */
class GrandsComptes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Grands_Comptes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrandsComptes;

    /**
     * @var string
     *
     * @ORM\Column(name="Grands_Comptes", type="string", length=50, nullable=false)
     */
    private $grandsComptes;

    public function getIdGrandsComptes(): ?int
    {
        return $this->idGrandsComptes;
    }

    public function getGrandsComptes(): ?string
    {
        return $this->grandsComptes;
    }

    public function setGrandsComptes(string $grandsComptes): self
    {
        $this->grandsComptes = $grandsComptes;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getGrandsComptes();
    }

}

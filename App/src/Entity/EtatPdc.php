<?php

namespace App\Entity;

use App\Repository\EtatPdcRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatPdcRepository::class)
 */
class EtatPdc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_etat_pdc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtatPdc;

    /**
     * @ORM\Column(name="etat_pdc", type="string", length=255, nullable=false)
     */
    private $etatPdc;


    public function getEtatPdc(): ?string
    {
        return $this->etatPdc;
    }

    public function setEtatPdc(string $etatPdc): self
    {
        $this->etatPdc = $etatPdc;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdEtatPdc(): int
    {
        return $this->idEtatPdc;
    }

    public function __toString(): string
    {
        return $this->getEtatPdc();
    }
}

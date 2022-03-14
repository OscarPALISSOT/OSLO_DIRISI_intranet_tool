<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Priorisation
 *
 * @ORM\Table(name="priorisation")
 * @ORM\Entity(repositoryClass="App\Repository\PriorisationRepository")
 */
class Priorisation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_priorisation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPriorisation;

    /**
     * @var string
     *
     * @ORM\Column(name="priorisation", type="string", length=50, nullable=false)
     */
    private $priorisation;

    public function getIdPriorisation(): ?int
    {
        return $this->idPriorisation;
    }

    public function getPriorisation(): ?string
    {
        return $this->priorisation;
    }

    public function setPriorisation(string $priorisation): self
    {
        $this->priorisation = $priorisation;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getPriorisation();
    }

}

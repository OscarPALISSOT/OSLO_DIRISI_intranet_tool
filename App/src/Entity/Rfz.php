<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rfz
 *
 * @ORM\Entity(repositoryClass="App\Repository\RfzRepository")
 * @ORM\Table(name="rfz")
 */
class Rfz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rfz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRfz;

    /**
     * @var string
     *
     * @ORM\Column(name="rfz", type="string", length=50, nullable=false)
     */
    private $rfz;

    public function getIdRfz(): ?int
    {
        return $this->idRfz;
    }

    public function getRfz(): ?string
    {
        return $this->rfz;
    }

    public function setRfz(string $rfz): self
    {
        $this->rfz = $rfz;

        return $this;
    }


}

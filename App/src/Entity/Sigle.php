<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sigle
 *
 * @ORM\Table(name="sigle")
 * @ORM\Entity
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
     * @ORM\Column(name="sigle", type="string", length=50, nullable=false)
     */
    private $sigle;

    public function getIdSigle(): ?int
    {
        return $this->idSigle;
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


}

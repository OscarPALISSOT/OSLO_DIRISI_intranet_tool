<?php

namespace App\Entity;

use App\Repository\SupportInternetMilitaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupportInternetMilitaireRepository::class)
 */
class SupportInternetMilitaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_support_internet_militaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSupportInternetMilitaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $support;

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getIdSupportInternetMilitaire(): ?int
    {
        return $this->idSupportInternetMilitaire;
    }

    public function __toString(): string
    {
        return $this->getSupport();
    }
}

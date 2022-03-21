<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureAffaire
 *
 * @ORM\Table(name="nature_affaire")
 * @ORM\Entity(repositoryClass="App\Repository\NatureAffaireRepository")
 */
class NatureAffaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_nature_Affaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNatureAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="nature_Affaire", type="string", length=50, nullable=false)
     */
    private $natureAffaire;

    public function getIdNatureAffaire(): ?int
    {
        return $this->idNatureAffaire;
    }

    public function getNatureAffaire(): ?string
    {
        return $this->natureAffaire;
    }

    public function setNatureAffaire(string $natureAffaire): self
    {
        $this->natureAffaire = $natureAffaire;

        return $this;
    }


}

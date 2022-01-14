<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organisme
 *
 * @ORM\Entity(repositoryClass="App\Repository\OrganismeRepository")
 * @ORM\Table(name="organisme", indexes={@ORM\Index(name="Organisme_quartiers_FK", columns={"id_quartier"})})
 */
class Organisme
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_organisme", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrganisme;

    /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=50, nullable=false)
     */
    private $organisme;

    /**
     * @var \Quartiers
     *
     * @ORM\ManyToOne(targetEntity="Quartiers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quartier", referencedColumnName="id_quartier")
     * })
     */
    private $idQuartier;

    public function getIdOrganisme(): ?int
    {
        return $this->idOrganisme;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(string $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getIdQuartier(): ?Quartiers
    {
        return $this->idQuartier;
    }

    public function setIdQuartier(?Quartiers $idQuartier): self
    {
        $this->idQuartier = $idQuartier;

        return $this;
    }


}

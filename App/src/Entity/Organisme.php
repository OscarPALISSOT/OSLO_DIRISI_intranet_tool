<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organisme
 *
 * @ORM\Table(name="organisme", indexes={@ORM\Index(name="Organisme_quartiers_FK", columns={"id_quartier"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrganismeRepository")
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Feb", mappedBy="idOrganisme")
     */
    private $idFeb;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idFeb = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * @return Collection<int, Feb>
     */
    public function getIdFeb(): Collection
    {
        return $this->idFeb;
    }

    public function addIdFeb(Feb $idFeb): self
    {
        if (!$this->idFeb->contains($idFeb)) {
            $this->idFeb[] = $idFeb;
            $idFeb->addIdOrganisme($this);
        }

        return $this;
    }

    public function removeIdFeb(Feb $idFeb): self
    {
        if ($this->idFeb->removeElement($idFeb)) {
            $idFeb->removeIdOrganisme($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getOrganisme();
    }
}

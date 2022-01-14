<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quartiers
 *
 * @ORM\Entity(repositoryClass="App\Repository\QuartiersRepository")
 * @ORM\Table(name="quartiers", indexes={@ORM\Index(name="quartiers_Bases_de_defense_FK", columns={"id_base_defense"})})
 */
class Quartiers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_quartier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuartier;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=50, nullable=false)
     */
    private $quartier;

    /**
     * @var string
     *
     * @ORM\Column(name="trigramme", type="string", length=50, nullable=false)
     */
    private $trigramme;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_quartier", type="string", length=50, nullable=false)
     */
    private $adresseQuartier;

    /**
     * @var \BasesDeDefense
     *
     * @ORM\ManyToOne(targetEntity="BasesDeDefense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_base_defense", referencedColumnName="id_base_defense")
     * })
     */
    private $idBaseDefense;

    public function getIdQuartier(): ?int
    {
        return $this->idQuartier;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getTrigramme(): ?string
    {
        return $this->trigramme;
    }

    public function setTrigramme(string $trigramme): self
    {
        $this->trigramme = $trigramme;

        return $this;
    }

    public function getAdresseQuartier(): ?string
    {
        return $this->adresseQuartier;
    }

    public function setAdresseQuartier(string $adresseQuartier): self
    {
        $this->adresseQuartier = $adresseQuartier;

        return $this;
    }

    public function getIdBaseDefense(): ?BasesDeDefense
    {
        return $this->idBaseDefense;
    }

    public function setIdBaseDefense(?BasesDeDefense $idBaseDefense): self
    {
        $this->idBaseDefense = $idBaseDefense;

        return $this;
    }


}

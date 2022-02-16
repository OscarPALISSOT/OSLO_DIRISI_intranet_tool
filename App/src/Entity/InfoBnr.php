<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoBnr
 *
 * @ORM\Table(name="info_bnr", indexes={@ORM\Index(name="info_Bnr_Affaire_FK", columns={"id_Affaire"})})
 * @ORM\Entity(repositoryClass="App\Repository\InfoBnrRepository")
 */
class InfoBnr
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_info_bnr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInfoBnr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=false)
     */
    private $dateDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="montant_info", type="text", length=0, nullable=false)
     */
    private $montantInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="impact", type="text", length=0, nullable=false)
     */
    private $impact;

    /**
     * @var \Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Affaire", referencedColumnName="id_Affaire")
     * })
     */
    private $idAffaire;

    public function getIdInfoBnr(): ?int
    {
        return $this->idInfoBnr;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getMontantInfo(): ?string
    {
        return $this->montantInfo;
    }

    public function setMontantInfo(string $montantInfo): self
    {
        $this->montantInfo = $montantInfo;

        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }

    public function setImpact(string $impact): self
    {
        $this->impact = $impact;

        return $this;
    }

    public function getIdAffaire(): ?Affaire
    {
        return $this->idAffaire;
    }

    public function setIdAffaire(?Affaire $idAffaire): self
    {
        $this->idAffaire = $idAffaire;

        return $this;
    }


}

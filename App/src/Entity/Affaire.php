<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Affaire
 *
 * @ORM\Table(name="affaire", indexes={@ORM\Index(name="Affaire_Grands_Comptes0_FK", columns={"id_Grands_Comptes"}), @ORM\Index(name="Affaire_Nature_Affaire1_FK", columns={"id_nature_Affaire"}), @ORM\Index(name="Affaire_Feb2_FK", columns={"id_feb"}), @ORM\Index(name="Affaire_Priorisation_FK", columns={"id_priorisation"})})
 * @ORM\Entity(repositoryClass="App\Repository\AffaireRepository")
 */
class Affaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Affaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif_Affaire", type="string", length=50, nullable=false)
     */
    private $objectifAffaire;

    /**
     * @var int
     *
     * @ORM\Column(name="montant_Affaire", type="integer", nullable=false)
     */
    private $montantAffaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="echeance_Affaire", type="date", nullable=false)
     */
    private $echeanceAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_Affaire", type="string", length=50, nullable=false)
     */
    private $etatAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=false)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    /**
     * @var \Feb
     *
     * @ORM\ManyToOne(targetEntity="Feb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_feb", referencedColumnName="id_feb")
     * })
     */
    private $idFeb;

    /**
     * @var \NatureAffaire
     *
     * @ORM\ManyToOne(targetEntity="NatureAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nature_Affaire", referencedColumnName="id_nature_Affaire")
     * })
     */
    private $idNatureAffaire;

    /**
     * @var \GrandsComptes
     *
     * @ORM\ManyToOne(targetEntity="GrandsComptes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Grands_Comptes", referencedColumnName="id_Grands_Comptes")
     * })
     */
    private $idGrandsComptes;

    /**
     * @var \Priorisation
     *
     * @ORM\ManyToOne(targetEntity="Priorisation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_priorisation", referencedColumnName="id_priorisation")
     * })
     */
    private $idPriorisation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Organisme", mappedBy="idAffaire")
     */
    private $idOrganisme;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOrganisme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAffaire(): ?int
    {
        return $this->idAffaire;
    }

    public function getObjectifAffaire(): ?string
    {
        return $this->objectifAffaire;
    }

    public function setObjectifAffaire(string $objectifAffaire): self
    {
        $this->objectifAffaire = $objectifAffaire;

        return $this;
    }

    public function getMontantAffaire(): ?int
    {
        return $this->montantAffaire;
    }

    public function setMontantAffaire(int $montantAffaire): self
    {
        $this->montantAffaire = $montantAffaire;

        return $this;
    }

    public function getEcheanceAffaire(): ?\DateTimeInterface
    {
        return $this->echeanceAffaire;
    }

    public function setEcheanceAffaire(\DateTimeInterface $echeanceAffaire): self
    {
        $this->echeanceAffaire = $echeanceAffaire;

        return $this;
    }

    public function getEtatAffaire(): ?string
    {
        return $this->etatAffaire;
    }

    public function setEtatAffaire(string $etatAffaire): self
    {
        $this->etatAffaire = $etatAffaire;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getIdFeb(): ?Feb
    {
        return $this->idFeb;
    }

    public function setIdFeb(?Feb $idFeb): self
    {
        $this->idFeb = $idFeb;

        return $this;
    }

    public function getIdNatureAffaire(): ?NatureAffaire
    {
        return $this->idNatureAffaire;
    }

    public function setIdNatureAffaire(?NatureAffaire $idNatureAffaire): self
    {
        $this->idNatureAffaire = $idNatureAffaire;

        return $this;
    }

    public function getIdGrandsComptes(): ?GrandsComptes
    {
        return $this->idGrandsComptes;
    }

    public function setIdGrandsComptes(?GrandsComptes $idGrandsComptes): self
    {
        $this->idGrandsComptes = $idGrandsComptes;

        return $this;
    }

    public function getIdPriorisation(): ?Priorisation
    {
        return $this->idPriorisation;
    }

    public function setIdPriorisation(?Priorisation $idPriorisation): self
    {
        $this->idPriorisation = $idPriorisation;

        return $this;
    }

    /**
     * @return Collection|Organisme[]
     */
    public function getIdOrganisme(): Collection
    {
        return $this->idOrganisme;
    }

    public function addIdOrganisme(Organisme $idOrganisme): self
    {
        if (!$this->idOrganisme->contains($idOrganisme)) {
            $this->idOrganisme[] = $idOrganisme;
            $idOrganisme->addIdAffaire($this);
        }

        return $this;
    }

    public function removeIdOrganisme(Organisme $idOrganisme): self
    {
        if ($this->idOrganisme->removeElement($idOrganisme)) {
            $idOrganisme->removeIdAffaire($this);
        }

        return $this;
    }

}

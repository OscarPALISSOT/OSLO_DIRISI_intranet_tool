<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlanDeCharge
 *
 * @ORM\Table(name="plan_de_charge", indexes={@ORM\Index(name="Plan_de_Charge_Grands_Comptes0_FK", columns={"id_Grands_Comptes"}),@ORM\Index(name="Plan_de_Charge_Statut_Pdc_FK", columns={"id_statut_pdc"})})
 * @ORM\Entity(repositoryClass="App\Repository\PlanDeChargeRepository")
 */
class PlanDeCharge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pdc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPdc;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_pdc", type="string", length=255, nullable=false)
     */
    private $intitulePdc;

    /**
     * @var string
     *
     * @ORM\Column(name="num_pdc", type="string", length=50, nullable=false)
     */
    private $numPdc;

    /**
     * @var float
     * @ORM\Column(name="montant_pdc", type="decimal", scale=2, length=255, nullable=false)
     */
    private $montantPdc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="date", nullable=false)
     */
    private $updateat;

    /**
     * @var \StatutPdc
     *
     * @ORM\ManyToOne(targetEntity="StatutPdc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_statut_pdc", referencedColumnName="id_statut_pdc")
     * })
     */
    private $idStatutPdc;

    /**
     * @var \EtatPdc
     *
     * @ORM\ManyToOne(targetEntity="EtatPdc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etat_pdc", referencedColumnName="id_etat_pdc")
     * })
     */
    private $idEtatPdc;
    
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Organisme", inversedBy="idPdc")
     * @ORM\JoinTable(name="beneficier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_pdc", referencedColumnName="id_pdc")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_organisme", referencedColumnName="id_organisme")
     *   }
     * )
     */
    private $idOrganisme;

    public function __construct()
    {
        $this->idOrganisme = new \Doctrine\Common\Collections\ArrayCollection();
        $date = new DateTime();
        $date->format('Y-m-d-H:i:s');
        $this->setUpdateAt($date);
    }

    public function getIdPdc(): ?int
    {
        return $this->idPdc;
    }

    public function getNumPdc(): ?string
    {
        return $this->numPdc;
    }

    public function setNumPdc(string $numPdc): self
    {
        $this->numPdc = $numPdc;

        return $this;
    }

    public function getMontantPdc(): ?float
    {
        return $this->montantPdc;
    }

    public function setMontantPdc(float $montantPdc): self
    {
        $this->montantPdc = $montantPdc;

        return $this;
    }

    public function getUpdateat(): ?\DateTimeInterface
    {
        return $this->updateat;
    }

    public function setUpdateat(\DateTimeInterface $updateat): self
    {
        $this->updateat = $updateat;

        return $this;
    }

    public function getIdStatutPdc(): ?StatutPdc
    {
        return $this->idStatutPdc;
    }

    public function setIdStatutPdc(?StatutPdc $idStatutPdc): self
    {
        $this->idStatutPdc = $idStatutPdc;

        return $this;
    }

    public function getIdEtatPdc(): ?EtatPdc
    {
        return $this->idEtatPdc;
    }

    public function setIdEtatPdc(?EtatPdc $idEtatPdc): self
    {
        $this->idEtatPdc = $idEtatPdc;

        return $this;
    }

    public function getIntitulePdc(): ?string
    {
        return $this->intitulePdc;
    }

    public function setIntitulePdc(string $intitulePdc): self
    {
        $this->intitulePdc = $intitulePdc;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getIntitulePdc();
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

    /**
     * @return Collection<int, Organisme>
     */
    public function getIdOrganisme(): Collection
    {
        return $this->idOrganisme;
    }

    public function addIdOrganisme(Organisme $idOrganisme): self
    {
        if (!$this->idOrganisme->contains($idOrganisme)) {
            $this->idOrganisme[] = $idOrganisme;
        }

        return $this;
    }

    public function removeIdOrganisme(Organisme $idOrganisme): self
    {
        $this->idOrganisme->removeElement($idOrganisme);

        return $this;
    }

}

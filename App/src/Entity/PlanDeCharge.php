<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlanDeCharge
 *
 * @ORM\Table(name="plan_de_charge", indexes={@ORM\Index(name="Plan_de_Charge_Statut_Pdc_FK", columns={"id_statut_pdc"})})
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
     * @var int
     *
     * @ORM\Column(name="montant_pdc", type="integer", nullable=false)
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

    public function __construct()
    {
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

    public function getMontantPdc(): ?int
    {
        return $this->montantPdc;
    }

    public function setMontantPdc(int $montantPdc): self
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


}

<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Feb
 *
 * @ORM\Table(name="feb", indexes={@ORM\Index(name="Feb_Plan_de_Charge_FK", columns={"id_pdc"})})
 * @ORM\Entity(repositoryClass="App\Repository\FebRepository")
 */
class Feb
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_feb", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeb;

    /**
     * @var string
     *
     * @ORM\Column(name="num_feb", type="string", length=50, nullable=false)
     */
    private $numFeb;

    /**
     * @var int
     *
     * @ORM\Column(name="montant_feb", type="integer", nullable=false)
     */
    private $montantFeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    /**
     * @var \PlanDeCharge
     *
     * @ORM\ManyToOne(targetEntity="PlanDeCharge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pdc", referencedColumnName="id_pdc")
     * })
     */
    private $idPdc;

    public function __construct()
    {
        $date = new DateTime();
        $date->format('Y-m-d-H:i:s');
        $this->setUpdateAt($date);
    }

    public function getIdFeb(): ?int
    {
        return $this->idFeb;
    }

    public function getNumFeb(): ?string
    {
        return $this->numFeb;
    }

    public function setNumFeb(string $numFeb): self
    {
        $this->numFeb = $numFeb;

        return $this;
    }

    public function getMontantFeb(): ?int
    {
        return $this->montantFeb;
    }

    public function setMontantFeb(int $montantFeb): self
    {
        $this->montantFeb = $montantFeb;

        return $this;
    }

    public function getIdPdc(): ?PlanDeCharge
    {
        return $this->idPdc;
    }

    public function setIdPdc(?PlanDeCharge $idPdc): self
    {
        $this->idPdc = $idPdc;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNumFeb();
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt(): \DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt(\DateTime $updateAt): void
    {
        $this->updateAt = $updateAt;
    }


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BasesDeDefense
 *
 * @ORM\Table(name="bases_de_defense", uniqueConstraints={@ORM\UniqueConstraint(name="Bases_de_defense_Budget_FebCOm_AK", columns={"id_budget_FebCom"})}, indexes={@ORM\Index(name="Bases_de_defense_rfz_FK", columns={"id_rfz"})})
 * @ORM\Entity(repositoryClass="App\Repository\BasesDeDefenseRepository")
 */
class BasesDeDefense
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_base_defense", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBaseDefense;

    /**
     * @var string
     *
     * @ORM\Column(name="base_defense", type="string", length=50, nullable=false)
     */
    private $baseDefense;

    /**
     * @var \Rfz
     *
     * @ORM\ManyToOne(targetEntity="Rfz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rfz", referencedColumnName="id_rfz")
     * })
     */
    private $idRfz;

    /**
     * @var \BudgetFebcom
     *
     * @ORM\ManyToOne(targetEntity="BudgetFebcom")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_budget_FebCom", referencedColumnName="id_budget_FebCom")
     * })
     */
    private $idBudgetFebcom;

    public function getIdBaseDefense(): ?int
    {
        return $this->idBaseDefense;
    }

    public function getBaseDefense(): ?string
    {
        return $this->baseDefense;
    }

    public function setBaseDefense(string $baseDefense): self
    {
        $this->baseDefense = $baseDefense;

        return $this;
    }

    public function getIdRfz(): ?Rfz
    {
        return $this->idRfz;
    }

    public function setIdRfz(?Rfz $idRfz): self
    {
        $this->idRfz = $idRfz;

        return $this;
    }

    public function getIdBudgetFebcom(): ?BudgetFebcom
    {
        return $this->idBudgetFebcom;
    }

    public function setIdBudgetFebcom(?BudgetFebcom $idBudgetFebcom): self
    {
        $this->idBudgetFebcom = $idBudgetFebcom;

        return $this;
    }

    public function __toString()
    {
        return $this->getBaseDefense();
    }


}

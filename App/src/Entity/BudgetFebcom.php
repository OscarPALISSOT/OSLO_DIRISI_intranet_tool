<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BudgetFebcom
 *
 * @ORM\Table(name="budget_febcom")
 * @ORM\Entity(repositoryClass="App\Repository\BudgetFebcomRepository")
 */
class BudgetFebcom
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_budget_FebCom", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBudgetFebcom;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_FebCom", type="string", length=50, nullable=false)
     */
    private $anneeFebcom;

    /**
     * @var int
     *
     * @ORM\Column(name="enveloppe", type="integer", nullable=false)
     */
    private $enveloppe;

    /**
     * @var int
     *
     * @ORM\Column(name="1er_versement", type="integer", nullable=false)
     */
    private $premierVersement;

    /**
     * @var int
     *
     * @ORM\Column(name="2eme_versement", type="integer", nullable=false)
     */
    private $secondVersement;

    /**
     * @var int
     *
     * @ORM\Column(name="FebCom_consomme", type="integer", nullable=false)
     */
    private $febcomConsomme;

    /**
     * @var int
     *
     * @ORM\Column(name="reliquat_1er_versement", type="integer", nullable=false)
     */
    private $reliquat1erVersement;

    /**
     * @var int
     *
     * @ORM\Column(name="reliquat_2eme_versement", type="integer", nullable=false)
     */
    private $reliquat2emeVersement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    public function getIdBudgetFebcom(): ?int
    {
        return $this->idBudgetFebcom;
    }

    public function getAnneeFebcom(): ?string
    {
        return $this->anneeFebcom;
    }

    public function setAnneeFebcom(string $anneeFebcom): self
    {
        $this->anneeFebcom = $anneeFebcom;

        return $this;
    }

    public function getEnveloppe(): ?int
    {
        return $this->enveloppe;
    }

    public function setEnveloppe(int $enveloppe): self
    {
        $this->enveloppe = $enveloppe;

        return $this;
    }

    public function getPremierVersement(): ?int
    {
        return $this->premierVersement;
    }

    public function setPremierVersement(int $premierVersement): self
    {
        $this->premierVersement = $premierVersement;

        return $this;
    }

    public function getSecondVersement(): ?int
    {
        return $this->secondVersement;
    }

    public function setSecondVersement(int $secondVersement): self
    {
        $this->secondVersement = $secondVersement;

        return $this;
    }

    public function getFebcomConsomme(): ?int
    {
        return $this->febcomConsomme;
    }

    public function setFebcomConsomme(int $febcomConsomme): self
    {
        $this->febcomConsomme = $febcomConsomme;

        return $this;
    }

    public function getReliquat1erVersement(): ?int
    {
        return $this->reliquat1erVersement;
    }

    public function setReliquat1erVersement(int $reliquat1erVersement): self
    {
        $this->reliquat1erVersement = $reliquat1erVersement;

        return $this;
    }

    public function getReliquat2emeVersement(): ?int
    {
        return $this->reliquat2emeVersement;
    }

    public function setReliquat2emeVersement(int $reliquat2emeVersement): self
    {
        $this->reliquat2emeVersement = $reliquat2emeVersement;

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


}

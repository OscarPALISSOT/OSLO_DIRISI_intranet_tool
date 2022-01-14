<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bnr
 *
 * @ORM\Entity(repositoryClass="App\Repository\BnrRepository")
 * @ORM\Table(name="bnr", indexes={@ORM\Index(name="Bnr_Organisme_FK", columns={"id_organisme"})})
 */
class Bnr
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_bnr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="prio_bnr", type="string", length=50, nullable=false)
     */
    private $prioBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_bnr", type="string", length=50, nullable=false)
     */
    private $objBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="montant_feb", type="string", length=50, nullable=false)
     */
    private $montantFeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="echeance_bnr", type="date", nullable=false)
     */
    private $echeanceBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_bnr", type="string", length=50, nullable=false)
     */
    private $commentaireBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_bnr", type="string", length=50, nullable=false)
     */
    private $etatBnr;

    /**
     * @var \Organisme
     *
     * @ORM\ManyToOne(targetEntity="Organisme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_organisme", referencedColumnName="id_organisme")
     * })
     */
    private $idOrganisme;

    public function getIdBnr(): ?int
    {
        return $this->idBnr;
    }

    public function getPrioBnr(): ?string
    {
        return $this->prioBnr;
    }

    public function setPrioBnr(string $prioBnr): self
    {
        $this->prioBnr = $prioBnr;

        return $this;
    }

    public function getObjBnr(): ?string
    {
        return $this->objBnr;
    }

    public function setObjBnr(string $objBnr): self
    {
        $this->objBnr = $objBnr;

        return $this;
    }

    public function getMontantFeb(): ?string
    {
        return $this->montantFeb;
    }

    public function setMontantFeb(string $montantFeb): self
    {
        $this->montantFeb = $montantFeb;

        return $this;
    }

    public function getEcheanceBnr(): ?\DateTimeInterface
    {
        return $this->echeanceBnr;
    }

    public function setEcheanceBnr(\DateTimeInterface $echeanceBnr): self
    {
        $this->echeanceBnr = $echeanceBnr;

        return $this;
    }

    public function getCommentaireBnr(): ?string
    {
        return $this->commentaireBnr;
    }

    public function setCommentaireBnr(string $commentaireBnr): self
    {
        $this->commentaireBnr = $commentaireBnr;

        return $this;
    }

    public function getEtatBnr(): ?string
    {
        return $this->etatBnr;
    }

    public function setEtatBnr(string $etatBnr): self
    {
        $this->etatBnr = $etatBnr;

        return $this;
    }

    public function getIdOrganisme(): ?Organisme
    {
        return $this->idOrganisme;
    }

    public function setIdOrganisme(?Organisme $idOrganisme): self
    {
        $this->idOrganisme = $idOrganisme;

        return $this;
    }


}

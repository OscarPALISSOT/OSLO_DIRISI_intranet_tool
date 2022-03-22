<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * AccesWan
 *
 * @ORM\Table(name="acces_wan", indexes={@ORM\Index(name="Acces_Wan_quartiers_FK", columns={"id_quartier"})})
 * @ORM\Entity(repositoryClass="App\Repository\AccesWanRepository")
 */
class AccesWan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_opera", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOpera;

    /**
     * @var string
     *
     * @ORM\Column(name="id_access", type="string", length=255, nullable=false)
     */
    private $idAccess;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=255, nullable=false)
     */
    private $origine;

    /**
     * @var string
     *
     * @ORM\Column(name="type_opera", type="string", length=50, nullable=false)
     */
    private $typeOpera;

    /**
     * @var int
     *
     * @ORM\Column(name="debit_opera", type="integer", nullable=false)
     */
    private $debitOpera;

    /**
     * @var int
     *
     * @ORM\Column(name="cout_mensuel_opera", type="decimal", scale=2, nullable=false)
     */
    private $coutMensuel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_opera", type="string", length=50, nullable=false)
     */
    private $etatOpera;

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
     * @var \Quartiers
     *
     * @ORM\ManyToOne(targetEntity="Quartiers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quartier", referencedColumnName="id_quartier")
     * })
     */
    private $idQuartier;

    public function __construct()
    {
        $date = new DateTime();
        $date->format('Y-m-d-H:i:s');
        $this->setUpdateAt($date);
    }

    public function getIdOpera(): ?int
    {
        return $this->idOpera;
    }

    public function getIdAccess(): ?string
    {
        return $this->idAccess;
    }

    public function setIdAccess(string $idAccess): self
    {
        $this->idAccess = $idAccess;

        return $this;
    }

    public function getTypeOpera(): ?string
    {
        return $this->typeOpera;
    }

    public function setTypeOpera(string $typeOpera): self
    {
        $this->typeOpera = $typeOpera;

        return $this;
    }

    public function getDebitOpera(): ?int
    {
        return $this->debitOpera;
    }

    public function setDebitOpera(int $debitOpera): self
    {
        $this->debitOpera = $debitOpera;

        return $this;
    }

    public function getEtatOpera(): ?string
    {
        return $this->etatOpera;
    }

    public function setEtatOpera(string $etatOpera): self
    {
        $this->etatOpera = $etatOpera;

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

    public function getIdQuartier(): ?Quartiers
    {
        return $this->idQuartier;
    }

    public function setIdQuartier(?Quartiers $idQuartier): self
    {
        $this->idQuartier = $idQuartier;

        return $this;
    }

    public function getCoutMensuel(): ?string
    {
        return $this->coutMensuel;
    }

    public function setCoutMensuel(string $coutMensuel): self
    {
        $this->coutMensuel = $coutMensuel;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


}
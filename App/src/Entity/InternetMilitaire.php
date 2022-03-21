<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * InternetMilitaire
 *
 * @ORM\Table(name="internet_militaire", indexes={@ORM\Index(name="internet_militaire_Support_FK", columns={"id_support_internet_militaire"})})
 * @ORM\Entity(repositoryClass="App\Repository\InternetMilitaireRepository")
 */
class InternetMilitaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_internet_militaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInternetMilitaire;

    /**
     * @var string
     *
     * @ORM\Column(name="master_id", type="string", length=50, nullable=false)
     */
    private $masterId;

    /**
     * @var int
     *
     * @ORM\Column(name="debit_internet_militaire", type="string", length=255 )
     */
    private $debitInternetMilitaire;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_pfs", type="string", length=50, nullable=false)
     */
    private $ipPfs;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_lan_subnet", type="string", length=50, nullable=false)
     */
    private $ipLanSubnet;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_internet_militaire", type="string", length=50, nullable=false)
     */
    private $etatInternetMilitaire;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    /**
     * @var \Organisme
     *
     * @ORM\ManyToOne(targetEntity="Organisme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_organisme", referencedColumnName="id_organisme")
     * })
     */
    private $idOrganisme;

    /**
     * @var \SupportInternetMilitaire
     *
     * @ORM\ManyToOne(targetEntity="SupportInternetMilitaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_support_internet_militaire", referencedColumnName="id_support_internet_militaire")
     * })
     */
    private $idSupport;

    public function __construct()
    {
        $date = new DateTime();
        $date->format('Y-m-d-H:i:s');
        $this->setUpdateAt($date);
    }

    public function getIdInternetMilitaire(): ?int
    {
        return $this->idInternetMilitaire;
    }

    public function getMasterId(): ?string
    {
        return $this->masterId;
    }

    public function setMasterId(string $masterId): self
    {
        $this->masterId = $masterId;

        return $this;
    }

    public function getIpPfs(): ?string
    {
        return $this->ipPfs;
    }

    public function setIpPfs(string $ipPfs): self
    {
        $this->ipPfs = $ipPfs;

        return $this;
    }

    public function getIpLanSubnet(): ?string
    {
        return $this->ipLanSubnet;
    }

    public function setIpLanSubnet(string $ipLanSubnet): self
    {
        $this->ipLanSubnet = $ipLanSubnet;

        return $this;
    }

    public function getEtatInternetMilitaire(): ?string
    {
        return $this->etatInternetMilitaire;
    }

    public function setEtatInternetMilitaire(string $etatInternetMilitaire): self
    {
        $this->etatInternetMilitaire = $etatInternetMilitaire;

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

    public function getIdOrganisme(): ?Organisme
    {
        return $this->idOrganisme;
    }

    public function setIdOrganisme(?Organisme $idOrganisme): self
    {
        $this->idOrganisme = $idOrganisme;

        return $this;
    }

    public function getDebitInternetMilitaire(): ?string
    {
        return $this->debitInternetMilitaire;
    }

    public function setDebitInternetMilitaire(string $debitInternetMilitaire): self
    {
        $this->debitInternetMilitaire = $debitInternetMilitaire;

        return $this;
    }

    public function getIdSupport(): ?SupportInternetMilitaire
    {
        return $this->idSupport;
    }

    public function setIdSupport(?SupportInternetMilitaire $idSupport): self
    {
        $this->idSupport = $idSupport;

        return $this;
    }

}

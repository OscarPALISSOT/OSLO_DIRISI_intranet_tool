<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoModip
 *
 * @ORM\Table(name="info_modip", indexes={@ORM\Index(name="Info_modip_Affaire_FK", columns={"id_Affaire"})})
 * @ORM\Entity(repositoryClass="App\Repository\InfoModipRepository")
 */
class InfoModip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_info_modip", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInfoModip;

    /**
     * @var string
     *
     * @ORM\Column(name="reno_avant", type="string", length=50, nullable=false)
     */
    private $renoAvant;

    /**
     * @var string
     *
     * @ORM\Column(name="reno_apres", type="string", length=50, nullable=false)
     */
    private $renoApres;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_coeur_av_tvx", type="integer", nullable=false)
     */
    private $anneeCoeurAvTvx;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_reno_coeur", type="integer", nullable=false)
     */
    private $anneeRenoCoeur;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_modip", type="integer", nullable=false)
     */
    private $anneeModip;

    /**
     * @var int
     *
     * @ORM\Column(name="semestre_modip", type="integer", nullable=false)
     */
    private $semestreModip;

    /**
     * @var \ClassementDl
     *
     * @ORM\ManyToOne(targetEntity="ClassementDl")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Classement_Dl", referencedColumnName="id_Classement_Dl")
     * })
     */
    private $idClassementDl;

    /**
     * @var \Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Affaire", referencedColumnName="id_Affaire")
     * })
     */
    private $idAffaire;

    public function getIdInfoModip(): ?int
    {
        return $this->idInfoModip;
    }

    public function getRenoAvant(): ?string
    {
        return $this->renoAvant;
    }

    public function setRenoAvant(string $renoAvant): self
    {
        $this->renoAvant = $renoAvant;

        return $this;
    }

    public function getRenoApres(): ?string
    {
        return $this->renoApres;
    }

    public function setRenoApres(string $renoApres): self
    {
        $this->renoApres = $renoApres;

        return $this;
    }

    public function getAnneeCoeurAvTvx(): ?int
    {
        return $this->anneeCoeurAvTvx;
    }

    public function setAnneeCoeurAvTvx(int $anneeCoeurAvTvx): self
    {
        $this->anneeCoeurAvTvx = $anneeCoeurAvTvx;

        return $this;
    }

    public function getAnneeRenoCoeur(): ?int
    {
        return $this->anneeRenoCoeur;
    }

    public function setAnneeRenoCoeur(int $anneeRenoCoeur): self
    {
        $this->anneeRenoCoeur = $anneeRenoCoeur;

        return $this;
    }

    public function getAnneeModip(): ?int
    {
        return $this->anneeModip;
    }

    public function setAnneeModip(int $anneeModip): self
    {
        $this->anneeModip = $anneeModip;

        return $this;
    }

    public function getSemestreModip(): ?int
    {
        return $this->semestreModip;
    }

    public function setSemestreModip(int $semestreModip): self
    {
        $this->semestreModip = $semestreModip;

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

    public function getIdClassementDl(): ?ClassementDl
    {
        return $this->idClassementDl;
    }

    public function setIdClassementDl(?ClassementDl $idClassementDl): self
    {
        $this->idClassementDl = $idClassementDl;

        return $this;
    }


}

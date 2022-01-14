<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modip
 *
 * @ORM\Entity(repositoryClass="App\Repository\ModipRepository")
 * @ORM\Table(name="modip", indexes={@ORM\Index(name="Modip_quartiers_FK", columns={"id_quartier"})})
 */
class Modip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_modip", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModip;

    /**
     * @var string
     *
     * @ORM\Column(name="num_declic", type="string", length=50, nullable=false)
     */
    private $numDeclic;

    /**
     * @var int
     *
     * @ORM\Column(name="classement_dl", type="integer", nullable=false)
     */
    private $classementDl;

    /**
     * @var string
     *
     * @ORM\Column(name="prio_declic", type="string", length=50, nullable=false)
     */
    private $prioDeclic;

    /**
     * @var string
     *
     * @ORM\Column(name="client_modip", type="string", length=50, nullable=false)
     */
    private $clientModip;

    /**
     * @var string
     *
     * @ORM\Column(name="classification_op_modip", type="string", length=50, nullable=false)
     */
    private $classificationOpModip;

    /**
     * @var int
     *
     * @ORM\Column(name="cout_modip", type="integer", nullable=false)
     */
    private $coutModip;

    /**
     * @var string
     *
     * @ORM\Column(name="description_modip", type="string", length=50, nullable=false)
     */
    private $descriptionModip;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_modip", type="string", length=50, nullable=false)
     */
    private $categorieModip;

    /**
     * @var string
     *
     * @ORM\Column(name="type_modip", type="string", length=50, nullable=false)
     */
    private $typeModip;

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
     * @var string
     *
     * @ORM\Column(name="semestre_modip", type="string", length=50, nullable=false)
     */
    private $semestreModip;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_modip", type="string", length=50, nullable=false)
     */
    private $etatModip;

    /**
     * @var \Quartiers
     *
     * @ORM\ManyToOne(targetEntity="Quartiers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quartier", referencedColumnName="id_quartier")
     * })
     */
    private $idQuartier;

    public function getIdModip(): ?int
    {
        return $this->idModip;
    }

    public function getNumDeclic(): ?string
    {
        return $this->numDeclic;
    }

    public function setNumDeclic(string $numDeclic): self
    {
        $this->numDeclic = $numDeclic;

        return $this;
    }

    public function getClassementDl(): ?int
    {
        return $this->classementDl;
    }

    public function setClassementDl(int $classementDl): self
    {
        $this->classementDl = $classementDl;

        return $this;
    }

    public function getPrioDeclic(): ?string
    {
        return $this->prioDeclic;
    }

    public function setPrioDeclic(string $prioDeclic): self
    {
        $this->prioDeclic = $prioDeclic;

        return $this;
    }

    public function getClientModip(): ?string
    {
        return $this->clientModip;
    }

    public function setClientModip(string $clientModip): self
    {
        $this->clientModip = $clientModip;

        return $this;
    }

    public function getClassificationOpModip(): ?string
    {
        return $this->classificationOpModip;
    }

    public function setClassificationOpModip(string $classificationOpModip): self
    {
        $this->classificationOpModip = $classificationOpModip;

        return $this;
    }

    public function getCoutModip(): ?int
    {
        return $this->coutModip;
    }

    public function setCoutModip(int $coutModip): self
    {
        $this->coutModip = $coutModip;

        return $this;
    }

    public function getDescriptionModip(): ?string
    {
        return $this->descriptionModip;
    }

    public function setDescriptionModip(string $descriptionModip): self
    {
        $this->descriptionModip = $descriptionModip;

        return $this;
    }

    public function getCategorieModip(): ?string
    {
        return $this->categorieModip;
    }

    public function setCategorieModip(string $categorieModip): self
    {
        $this->categorieModip = $categorieModip;

        return $this;
    }

    public function getTypeModip(): ?string
    {
        return $this->typeModip;
    }

    public function setTypeModip(string $typeModip): self
    {
        $this->typeModip = $typeModip;

        return $this;
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

    public function getSemestreModip(): ?string
    {
        return $this->semestreModip;
    }

    public function setSemestreModip(string $semestreModip): self
    {
        $this->semestreModip = $semestreModip;

        return $this;
    }

    public function getEtatModip(): ?string
    {
        return $this->etatModip;
    }

    public function setEtatModip(string $etatModip): self
    {
        $this->etatModip = $etatModip;

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


}

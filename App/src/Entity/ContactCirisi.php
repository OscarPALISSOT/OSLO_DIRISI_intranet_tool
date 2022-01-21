<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCirisi
 *
 * @ORM\Table(name="contact_cirisi", indexes={@ORM\Index(name="Contact_CIRISI_Cirisi_FK", columns={"id_cirisi"})})
 * @ORM\Entity(repositoryClass="App\Repository\ContactCirisiRepository")
 */
class ContactCirisi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contact_cirisi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContactCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_contact_cirisi", type="string", length=50, nullable=false)
     */
    private $intituleContactCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_contact_cirisi", type="string", length=50, nullable=false)
     */
    private $nomContactCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_contact_cirisi", type="string", length=50, nullable=false)
     */
    private $prenomContactCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="email_contact_cirisi", type="string", length=50, nullable=false)
     */
    private $emailContactCirisi;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_contact_cirisi", type="string", length=50, nullable=false)
     */
    private $telContactCirisi;

    /**
     * @var \Cirisi
     *
     * @ORM\ManyToOne(targetEntity="Cirisi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cirisi", referencedColumnName="id_cirisi")
     * })
     */
    private $idCirisi;

    public function getIdContactCirisi(): ?int
    {
        return $this->idContactCirisi;
    }

    public function getIntituleContactCirisi(): ?string
    {
        return $this->intituleContactCirisi;
    }

    public function setIntituleContactCirisi(string $intituleContactCirisi): self
    {
        $this->intituleContactCirisi = $intituleContactCirisi;

        return $this;
    }

    public function getNomContactCirisi(): ?string
    {
        return $this->nomContactCirisi;
    }

    public function setNomContactCirisi(string $nomContactCirisi): self
    {
        $this->nomContactCirisi = $nomContactCirisi;

        return $this;
    }

    public function getPrenomContactCirisi(): ?string
    {
        return $this->prenomContactCirisi;
    }

    public function setPrenomContactCirisi(string $prenomContactCirisi): self
    {
        $this->prenomContactCirisi = $prenomContactCirisi;

        return $this;
    }

    public function getEmailContactCirisi(): ?string
    {
        return $this->emailContactCirisi;
    }

    public function setEmailContactCirisi(string $emailContactCirisi): self
    {
        $this->emailContactCirisi = $emailContactCirisi;

        return $this;
    }

    public function getTelContactCirisi(): ?string
    {
        return $this->telContactCirisi;
    }

    public function setTelContactCirisi(string $telContactCirisi): self
    {
        $this->telContactCirisi = $telContactCirisi;

        return $this;
    }

    public function getIdCirisi(): ?Cirisi
    {
        return $this->idCirisi;
    }

    public function setIdCirisi(?Cirisi $idCirisi): self
    {
        $this->idCirisi = $idCirisi;

        return $this;
    }


}

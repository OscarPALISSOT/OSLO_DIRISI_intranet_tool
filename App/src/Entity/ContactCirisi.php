<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contactcirisi
 *
 * @ORM\Table(name="contactcirisi", indexes={@ORM\Index(name="ContactCirisi_Cirisi0_FK", columns={"id_cirisi"})})
 * @ORM\Entity(repositoryClass="App\Repository\ContactCirisiRepository")
 */
class ContactCirisi
{
    /**
     * @var string
     *
     * @ORM\Column(name="intitule_contact", type="string", length=50, nullable=false)
     */
    private $intituleContact;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_contact", type="string", length=50, nullable=false)
     */
    private $nomContact;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_contact", type="string", length=50, nullable=false)
     */
    private $prenomContact;

    /**
     * @var string
     *
     * @ORM\Column(name="email_contact", type="string", length=50, nullable=false)
     */
    private $emailContact;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_contact", type="string", length=50, nullable=false)
     */
    private $telContact;

    /**
     * @var \Contact
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contact", referencedColumnName="id_contact")
     * })
     */
    private $idContact;

    /**
     * @var \Cirisi
     *
     * @ORM\ManyToOne(targetEntity="Cirisi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cirisi", referencedColumnName="id_cirisi")
     * })
     */
    private $idCirisi;

    public function getIntituleContact(): ?string
    {
        return $this->intituleContact;
    }

    public function setIntituleContact(string $intituleContact): self
    {
        $this->intituleContact = $intituleContact;

        return $this;
    }

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenomContact;
    }

    public function setPrenomContact(string $prenomContact): self
    {
        $this->prenomContact = $prenomContact;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getTelContact(): ?string
    {
        return $this->telContact;
    }

    public function setTelContact(string $telContact): self
    {
        $this->telContact = $telContact;

        return $this;
    }

    public function getIdContact(): ?Contact
    {
        return $this->idContact;
    }

    public function setIdContact(?Contact $idContact): self
    {
        $this->idContact = $idContact;

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

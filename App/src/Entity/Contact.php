<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContact;

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

    public function getIdContact(): ?int
    {
        return $this->idContact;
    }

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


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutPdc
 *
 * @ORM\Table(name="statut_pdc")
 * @ORM\Entity(repositoryClass="App\Repository\StatutPdcRepository")
 */
class StatutPdc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_statut_pdc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatutPdc;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_pdc", type="string", length=50, nullable=false)
     */
    private $statutPdc;

    public function getIdStatutPdc(): ?int
    {
        return $this->idStatutPdc;
    }

    public function getStatutPdc(): ?string
    {
        return $this->statutPdc;
    }

    public function setStatutPdc(string $statutPdc): self
    {
        $this->statutPdc = $statutPdc;

        return $this;
    }


}

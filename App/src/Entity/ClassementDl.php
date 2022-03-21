<?php

namespace App\Entity;

use App\Repository\ClassementDlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Classement_Dl")
 * @ORM\Entity(repositoryClass=ClassementDlRepository::class)
 */
class ClassementDl
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_Classement_Dl", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClassementDl;

    /**
     * @var string
     *
     * @ORM\Column(name="Classment_Dl", type="integer", nullable=false)
     *
     */
    private $ClassementDl;



    public function getClassementDl(): ?int
    {
        return $this->ClassementDl;
    }

    public function setClassementDl(int $ClassementDl): self
    {
        $this->ClassementDl = $ClassementDl;

        return $this;
    }

    public function getIdClassementDl(): ?int
    {
        return $this->idClassementDl;
    }
}

<?php

namespace App\Data;

use App\Entity\Organisme;
use phpDocumentor\Reflection\Types\Boolean;

class SearchDataBnr{


    /**
     * @var string
     */
    private string $search = '';

    /**
     * @var string
     */
    private string $Bnr = '';


    /**
     * @var bool
     */
    private bool $PriorityP1;

    /**
     * @var bool
     */
    private bool $PriorityP2;

    /**
     * @var bool
     */
    private bool $PriorityP3;

    /**
     * @var bool
     */
    private bool $supMontant = true;


    /**
     * @var int
     */
    private int $Montant;

    /**
     * @var Organisme[]
     */
    private array $idOrganisme;

    /**
     * @var int
     */
    private int $idQuartier;


    /**
     * @var bool | null
     */
    private bool $before;

    /**
     * @var \DateTime | null
     */
    private ?\DateTime $Echeance;


    /**
     * @var bool | null
     */
    private bool $state;

    /**
     * @var string
     */
    private string $comment = '';

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * @param string $search
     */
    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

    /**
     * @return string
     */
    public function getBnr(): string
    {
        return $this->Bnr;
    }

    /**
     * @param string $Bnr
     */
    public function setBnr(string $Bnr): void
    {
        $this->Bnr = $Bnr;
    }

    /**
     * @return bool
     */
    public function isSupMontant(): bool
    {
        return $this->supMontant;
    }

    /**
     * @param bool $supMontant
     */
    public function setSupMontant(bool $supMontant): void
    {
        $this->supMontant = $supMontant;
    }

    /**
     * @return int
     */
    public function getMontant(): int
    {
        return $this->Montant;
    }

    /**
     * @param int $Montant
     */
    public function setMontant(int $Montant): void
    {
        $this->Montant = $Montant;
    }

    /**
     * @return int
     */
    public function getIdOrganisme(): int
    {
        return $this->idOrganisme;
    }

    /**
     * @param int $idOrganisme
     */
    public function setIdOrganisme(int $idOrganisme): void
    {
        $this->idOrganisme = $idOrganisme;
    }

    /**
     * @return int
     */
    public function getIdQuartier(): int
    {
        return $this->idQuartier;
    }

    /**
     * @param int $idQuartier
     */
    public function setIdQuartier(int $idQuartier): void
    {
        $this->idQuartier = $idQuartier;
    }

    /**
     * @return bool|null
     */
    public function getBefore(): ?bool
    {
        return $this->before;
    }

    /**
     * @param bool|null $before
     */
    public function setBefore(?bool $before): void
    {
        $this->before = $before;
    }

    /**
     * @return \DateTime|null
     */
    public function getEcheance(): ?\DateTime
    {
        return $this->Echeance;
    }

    /**
     * @param \DateTime|null $Echeance
     */
    public function setEcheance(?\DateTime $Echeance): void
    {
        $this->Echeance = $Echeance;
    }

    /**
     * @return bool|null
     */
    public function getState(): ?bool
    {
        return $this->state;
    }

    /**
     * @param bool|null $state
     */
    public function setState(?bool $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return bool
     */
    public function isPriorityP1(): bool
    {
        return $this->PriorityP1;
    }

    /**
     * @param bool $PriorityP1
     */
    public function setPriorityP1(bool $PriorityP1): void
    {
        $this->PriorityP1 = $PriorityP1;
    }

    /**
     * @return bool
     */
    public function isPriorityP2(): bool
    {
        return $this->PriorityP2;
    }

    /**
     * @param bool $PriorityP2
     */
    public function setPriorityP2(bool $PriorityP2): void
    {
        $this->PriorityP2 = $PriorityP2;
    }

    /**
     * @return bool
     */
    public function isPriorityP3(): bool
    {
        return $this->PriorityP3;
    }

    /**
     * @param bool $PriorityP3
     */
    public function setPriorityP3(bool $PriorityP3): void
    {
        $this->PriorityP3 = $PriorityP3;
    }


}

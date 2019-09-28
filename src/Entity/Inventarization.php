<?php


namespace App\Entity;


class Inventarization
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $type;
    /** @var string */
    protected $categoryName;
    /** @var string */
    protected $parametrsUnit;
    /** @var int */
    protected $dateOfReplacementRequired;
    /** @var string[] */
    protected $imegesOfUnit;
    /** @var UnitHistory[] */
    protected $listOfFixed;
    /** @var integer */
    protected $status;
    /** @var float */
    protected $longitude;
    /** @var float */
    protected $latitude;
    /** @var integer */
    protected $risk;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return string
     */
    public function getParametrsUnit(): string
    {
        return $this->parametrsUnit;
    }

    /**
     * @param string $parametrsUnit
     */
    public function setParametrsUnit(string $parametrsUnit): void
    {
        $this->parametrsUnit = $parametrsUnit;
    }

    /**
     * @return int
     */
    public function getDateOfReplacementRequired(): int
    {
        return $this->dateOfReplacementRequired;
    }

    /**
     * @param int $dateOfReplacementRequired
     */
    public function setDateOfReplacementRequired(int $dateOfReplacementRequired): void
    {
        $this->dateOfReplacementRequired = $dateOfReplacementRequired;
    }

    /**
     * @return string[]
     */
    public function getImegesOfUnit(): array
    {
        return $this->imegesOfUnit;
    }

    /**
     * @param string[] $imegesOfUnit
     */
    public function setImegesOfUnit(array $imegesOfUnit): void
    {
        $this->imegesOfUnit = $imegesOfUnit;
    }

    /**
     * @return UnitHistory[]
     */
    public function getListOfFixed(): array
    {
        return $this->listOfFixed;
    }

    /**
     * @param UnitHistory[] $listOfFixed
     */
    public function setListOfFixed(array $listOfFixed): void
    {
        $this->listOfFixed = $listOfFixed;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return int
     */
    public function getRisk(): int
    {
        return $this->risk;
    }

    /**
     * @param int $risk
     */
    public function setRisk(int $risk): void
    {
        $this->risk = $risk;
    }
}

<?php

namespace App\Entity;

use App\Helper\AuthorInterface;
use App\Helper\AuthorTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitHistoryRepository")
 */
class UnitHistory implements AuthorInterface
{
    use AuthorTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit", inversedBy="unitHistories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}

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

    public function getId(): ?int
    {
        return $this->id;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $executor;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $planDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $factDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getExecutor(): ?User
    {
        return $this->executor;
    }

    public function setExecutor(?User $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPlanDate(): ?\DateTimeInterface
    {
        return $this->planDate;
    }

    public function setPlanDate(?\DateTimeInterface $planDate): self
    {
        $this->planDate = $planDate;

        return $this;
    }

    public function getFactDate(): ?\DateTimeInterface
    {
        return $this->factDate;
    }

    public function setFactDate(?\DateTimeInterface $factDate): self
    {
        $this->factDate = $factDate;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
        }

        return $this;
    }
}

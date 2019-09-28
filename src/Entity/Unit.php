<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitRepository")
 */
class Unit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Layer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $layer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Unit", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $powerConsumption;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $powerGeneration;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $bandwidth;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Model")
     */
    private $model;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $unitCondition;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLayer(): ?Layer
    {
        return $this->layer;
    }

    public function setLayer(?Layer $layer): self
    {
        $this->layer = $layer;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getPowerConsumption(): ?float
    {
        return $this->powerConsumption;
    }

    public function setPowerConsumption(?float $powerConsumption): self
    {
        $this->powerConsumption = $powerConsumption;

        return $this;
    }

    public function getPowerGeneration(): ?float
    {
        return $this->powerGeneration;
    }

    public function setPowerGeneration(?float $powerGeneration): self
    {
        $this->powerGeneration = $powerGeneration;

        return $this;
    }

    public function getBandwidth(): ?float
    {
        return $this->bandwidth;
    }

    public function setBandwidth(?float $bandwidth): self
    {
        $this->bandwidth = $bandwidth;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

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

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getUnitCondition(): ?float
    {
        return $this->unitCondition;
    }

    public function setUnitCondition(?float $unitCondition): self
    {
        $this->unitCondition = $unitCondition;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Helper\AuthorInterface;
use App\Helper\AuthorTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendorRepository")
 */
class Vendor implements AuthorInterface
{
    use AuthorTrait;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Model", mappedBy="vendor")
     */
    private $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
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

    /**
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setVendor($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->contains($model)) {
            $this->models->removeElement($model);
            // set the owning side to null (unless already changed)
            if ($model->getVendor() === $this) {
                $model->setVendor(null);
            }
        }

        return $this;
    }
}

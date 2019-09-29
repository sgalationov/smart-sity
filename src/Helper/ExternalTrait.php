<?php


namespace App\Helper;


trait ExternalTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $externalId;

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }
}
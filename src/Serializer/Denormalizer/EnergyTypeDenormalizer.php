<?php

namespace App\Serializer\Denormalizer;

use App\Entity\EnergyType;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class EnergyTypeDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        /** @var EnergyType $entity */
        $entity = $this->getEntity($data, $type);
        $entity->setName($data['name'] ?? $entity->getName());
        return $entity;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == EnergyType::class;
    }

}

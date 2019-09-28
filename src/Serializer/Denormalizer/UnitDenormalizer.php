<?php

namespace App\Serializer\Denormalizer;

use App\Entity\Layer;
use App\Entity\Unit;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UnitDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        /** @var Unit $entity */
        $entity = $this->getEntity($data, $type);
        $entity->setName($data['name'] ?? $entity->getName());
        $entity->setPowerConsumption($data['powerConsumption'] ?? $entity->getPowerConsumption());
        $entity->setPowerGeneration($data['powerGeneration'] ?? $entity->getPowerGeneration());
        $entity->setBandwidth($data['bandwidth'] ?? $entity->getBandwidth());
        if (array_key_exists('layer', $data)) {
            /** @var Layer $chat */
            $layer = $this->getSerializer()->denormalize($data['layer'], Layer::class, $format, $context);
            $entity->setLayer($layer);
        }
        if (array_key_exists('parent', $data)) {
            /** @var Unit $parent */
            $parent = $this->getSerializer()->denormalize($data['parent'], Unit::class, $format, $context);
            $entity->setLayer($parent);
        }
        return $entity;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == Unit::class;
    }

}

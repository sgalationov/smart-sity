<?php

namespace App\Serializer\Normalizer;

use App\Entity\Unit;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UnitNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;
    private $layerNormalizer;
    private $modelNormalizer;

    public function __construct(
        ObjectNormalizer $normalizer,
        LayerNormalizer $layerNormalizer,
        ModelNormalizer $modelNormalizer
    ) {
        $this->normalizer = $normalizer;
        $this->layerNormalizer = $layerNormalizer;
        $this->modelNormalizer = $modelNormalizer;
    }

    /**
     * @param Unit $object
     * @param null $format
     * @param array $context
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'model' => $this->modelNormalizer->normalize($object->getModel(), $format, $context),
            'bandwidth' => $object->getBandwidth(),
            'powerGeneration' => $object->getPowerGeneration(),
            'powerConsumption' => $object->getPowerConsumption(),
            'latitude' => $object->getLatitude(),
            'longitude' => $object->getLongitude(),
            'parent' => $object->getParent() ? $this->normalize($object->getParent(), $format, $context) : null,
            'layer' => $this->layerNormalizer->normalize($object->getLayer(), $format, $context),
        ];

        // Here: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Unit;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

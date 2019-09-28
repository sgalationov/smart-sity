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
            'model' => $object->getModel() ? $this->modelNormalizer->normalize($object->getModel(), $format, $context) : null,
            'bandwidth' => $object->getBandwidth(),
            'powerGeneration' => $object->getPowerGeneration(),
            'powerConsumption' => $object->getPowerConsumption(),
            'latitude' => $object->getLatitude(),
            'longitude' => $object->getLongitude(),
            'parent' => $object->getParent() && !key_exists('is_parent', $context)
                ? $this->normalize($object->getParent(), $format, array_merge($context, ['is_parent' => true]))
                : null,
            'layer' => $object->getLayer() ? $this->layerNormalizer->normalize($object->getLayer(), $format, $context) : null,
        ];

        // Here: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        $b = $data instanceof Unit;
        return $b;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

<?php

namespace App\Serializer\Normalizer;

use App\Entity\Task;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TaskNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;
    private $unitNormalizer;

    public function __construct(ObjectNormalizer $normalizer, UnitNormalizer $unitNormalizer)
    {
        $this->normalizer = $normalizer;
        $this->unitNormalizer = $unitNormalizer;
    }

    /**
     * @param Task $object
     * @param null $format
     * @param array $context
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $this->normalizer->normalize($object, $format, $context),
            'unit' => $object->getUnit() ? $this->unitNormalizer->normalize($object->getUnit(), $format, $context) : null,
        ];

        // Here: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Task;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

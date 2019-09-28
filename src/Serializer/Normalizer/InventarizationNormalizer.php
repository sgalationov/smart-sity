<?php

namespace App\Serializer\Normalizer;

use App\Entity\EnergyType;
use App\Entity\Inventarization;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class InventarizationNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @param Inventarization $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = [
            'status' => $object->getStatus(),
            'type' => $object->getType(),
            'categoryName' => $object->getCategoryName(),
            'dateOfReplacementRequired' => $object->getDateOfReplacementRequired(),
            'parametrsUnit' => $object->getId(),
            'imegesOfUnit' => $object->getImegesOfUnit(),
            'listOfFixed' => $object->getListOfFixed(),
        ];

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof EnergyType;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

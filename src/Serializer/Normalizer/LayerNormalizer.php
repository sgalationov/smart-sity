<?php

namespace App\Serializer\Normalizer;

use App\Entity\Layer;
use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LayerNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $userNormalizer;

    public function __construct(UserNormalizer $normalizer)
    {
        $this->userNormalizer = $normalizer;
    }

    /**
     * @param Layer $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'createAt' => $object->getCreatedAt()->getTimestamp(),
            'author' => $this->userNormalizer->normalize($object->getAuthor(), User::class, $context),
        ];

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Layer;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

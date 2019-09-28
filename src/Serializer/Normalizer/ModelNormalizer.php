<?php

namespace App\Serializer\Normalizer;

use App\Entity\Model;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ModelNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;
    protected $userNormalizer;
    protected $vendorNormalizer;

    public function __construct(
        ObjectNormalizer $normalizer,
        UserNormalizer $userNormalizer,
        VendorNormalizer $vendorNormalizer
    ) {
        $this->normalizer = $normalizer;
        $this->userNormalizer = $userNormalizer;
        $this->vendorNormalizer = $vendorNormalizer;
    }

    /**
     * @param Model $object
     * @param null $format
     * @param array $context
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = [
            'id' => $object->getId(),
            'vendor' => $object->getVendor() ? $this->vendorNormalizer->normalize($object->getVendor(), $format, $context) : null,
            'author' => $this->userNormalizer->normalize($object->getAuthor(), $format, $context),
            'name' => $object->getName(),
        ];

        // Here: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Model;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

<?php

namespace App\Serializer\Denormalizer;

use App\Entity\Image;
use App\Entity\Layer;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ImageDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        /** @var Image $entity */
        $entity = $this->getEntity($data, $type);
        return $entity;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == Image::class;
    }

}

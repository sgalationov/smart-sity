<?php

namespace App\Serializer\Denormalizer;

use App\Entity\User;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        /** @var User $entity */
        $entity = $this->getEntity($data, $type);
        $entity->setLogin($data['name'] ?? $entity->getLogin());
        return $entity;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == User::class;
    }

}

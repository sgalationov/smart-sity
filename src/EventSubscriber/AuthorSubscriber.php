<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthorSubscriber implements EventSubscriberInterface
{
    public function onDoctrineOrmEntityListener($event)
    {

    }

    public static function getSubscribedEvents()
    {
        return [
            'doctrine.orm.entity_listener' => 'onDoctrineOrmEntityListener',
        ];
    }
}

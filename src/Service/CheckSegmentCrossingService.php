<?php


namespace App\Service;


use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class CheckSegmentCrossingService
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function check(Unit $unit)
    {
        if ($unit->getParent()) {
            $line = [[
                'longitude' =>  $unit->getLongitude(),
                'latitude' => $unit->getLatitude(),
            ],[
                'longitude' =>  $unit->getParent()->getLongitude(),
                'latitude' => $unit->getParent()->getLatitude(),
            ]];
        }
    }
}
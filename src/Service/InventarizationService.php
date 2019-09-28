<?php


namespace App\Service;


use App\Entity\Image;
use App\Entity\Inventarization;
use App\Entity\Task;
use App\Entity\UnitHistory;

class InventarizationService
{
    public function createInventarization(Task $task)
    {
        $inventarization = new Inventarization();
        $inventarization->setId($task->getId());
        $inventarization->setCategoryName($task->getUnit()->getLayer()->getName());
        $inventarization->setDateOfReplacementRequired(
            $task->getUnit()->getLastCheckAt() ? $task->getUnit()->getLastCheckAt()->getTimestamp(): 0
            + $task->getUnit()->getServiceInterval()
        );
        $inventarization->setImegesOfUnit(array_map(function (Image $image) {
            return $image->getPath();
        }, $task->getImages()->toArray()));
        $inventarization->setListOfFixed(array_map(function (UnitHistory $unitHistory) {
            return [
                'time' => $unitHistory->getCreatedAt(),
                'description' => $unitHistory->getComment()?:''
            ];
        }, $task->getUnit()->getUnitHistories()->toArray()));
        $inventarization->setType(
            $task->getUnit()->getModel()->getName() .
            ' ' .
            $task->getUnit()->getModel()->getVendor()->getName());
        $inventarization->setParametrsUnit($task->getComment());
        $inventarization->setStatus($task->getStatus());
        $inventarization->setLatitude($task->getUnit()->getLatitude());
        $inventarization->setLongitude($task->getUnit()->getLongitude());
        $inventarization->setRisk($task->getUnit()->getUnitCondition());
        $inventarization->setName($task->getUnit()->getName());
        $inventarization->setCheckDate($task->getUnit()->getLastCheckAt()->getTimestamp());
        return $inventarization;
    }
}
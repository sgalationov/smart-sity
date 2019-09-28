<?php


namespace App\Service;


use App\Entity\Unit;
use App\Helper\Point;
use Doctrine\ORM\EntityManagerInterface;

class CheckSegmentCrossingService
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param Unit $checkedUnit
     * @return array
     */
    public function check(Unit $checkedUnit)
    {
        $points = [];
        if ($checkedUnit->getParent()) {
            $units = $this->em->getRepository(Unit::class)->findAll();
            $point = new Point(0, 0);
            foreach ($units as $unit) {
                $result = $this->intersection(
                    new Point($checkedUnit->getLongitude(), $checkedUnit->getLatitude()),
                    new Point($checkedUnit->getParent()->getLongitude(), $checkedUnit->getParent()->getLatitude()),
                    new Point($unit->getLongitude(), $unit->getLatitude()),
                    new Point($unit->getParent()->getLongitude(), $unit->getParent()->getLatitude()),
                    $point
                );
                if ($result) {
                    $points[] = clone $point;
                }
            }
        }
        return $points;
    }

    protected function intersection(Point $start1, Point $end1, Point $start2, Point $end2, Point &$out_intersection)
    {
        $dir1 = $end1 - $start1;
        $dir2 = $end2 - $start2;

        //считаем уравнения прямых проходящих через отрезки
        $a1 = -$dir1->y;
        $b1 = +$dir1->x;
        $d1 = -($a1 * $start1->x + $b1 * $start1->y);

        $a2 = -$dir2->y;
        $b2 = +$dir2->x;
        $d2 = -($a2 * $start2->x + $b2 * $start2->y);

        //подставляем концы отрезков, для выяснения в каких полуплоскотях они
        $seg1_line2_start = $a2 * $start1->x + $b2 * $start1->y + $d2;
        $seg1_line2_end = $a2 * $end1->x + $b2 * $end1->y + $d2;
        $seg2_line1_start = $a1 * $start2->x + $b1 * $start2->y + $d1;
        $seg2_line1_end = $a1 * $end2->x + $b1 * $end2->y + $d1;

        //если концы одного отрезка имеют один знак, значит он в одной полуплоскости и пересечения нет.
        if ($seg1_line2_start * $seg1_line2_end >= 0 || $seg2_line1_start * $seg2_line1_end >= 0)
            return false;

        $u = $seg1_line2_start / ($seg1_line2_start - $seg1_line2_end);
        $out_intersection = $start1 + $u * $dir1;

        return true;
    }


}
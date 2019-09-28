<?php

namespace App\Repository;

use App\Entity\UnitHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UnitHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitHistory[]    findAll()
 * @method UnitHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitHistory::class);
    }

    // /**
    //  * @return UnitHistory[] Returns an array of UnitHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnitHistory
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

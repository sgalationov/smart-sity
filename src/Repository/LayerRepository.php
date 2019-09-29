<?php

namespace App\Repository;

use App\Entity\Layer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Layer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Layer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Layer[]    findAll()
 * @method Layer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Layer::class);
    }

    public function getLayers()
    {
        $qb = $this->createQueryBuilder('l', 'l.externalId');
        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Layer[] Returns an array of Layer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Layer
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

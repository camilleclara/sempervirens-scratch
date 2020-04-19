<?php

namespace App\Repository;

use App\Entity\Scroll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Scroll|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scroll|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scroll[]    findAll()
 * @method Scroll[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScrollRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scroll::class);
    }

    // /**
    //  * @return Scroll[] Returns an array of Scroll objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Scroll
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

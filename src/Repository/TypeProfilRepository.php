<?php

namespace App\Repository;

use App\Entity\TypeProfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeProfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeProfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeProfil[]    findAll()
 * @method TypeProfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeProfil::class);
    }

    // /**
    //  * @return TypeProfil[] Returns an array of TypeProfil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeProfil
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

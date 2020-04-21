<?php

namespace App\Repository;

use App\Entity\UserChallenge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserChallenge|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserChallenge|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserChallenge[]    findAll()
 * @method UserChallenge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserChallengeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChallenge::class);
    }

    // /**
    //  * @return UserChallenge[] Returns an array of UserChallenge objects
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
    public function findOneBySomeField($value): ?UserChallenge
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

<?php

namespace App\Repository;

use App\Entity\Seizoen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Seizoen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seizoen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seizoen[]    findAll()
 * @method Seizoen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeizoenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seizoen::class);
    }

    // /**
    //  * @return Seizoen[] Returns an array of Seizoen objects
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
    public function findOneBySomeField($value): ?Seizoen
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

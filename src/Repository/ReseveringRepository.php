<?php

namespace App\Repository;

use App\Entity\Resevering;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resevering|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resevering|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resevering[]    findAll()
 * @method Resevering[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReseveringRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resevering::class);
    }

    // /**
    //  * @return Resevering[] Returns an array of Resevering objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Resevering
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

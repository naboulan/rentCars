<?php

namespace App\Repository;

use App\Entity\datedenaissance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method datedenaissance|null find($id, $lockMode = null, $lockVersion = null)
 * @method datedenaissance|null findOneBy(array $criteria, array $orderBy = null)
 * @method datedenaissance[]    findAll()
 * @method datedenaissance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class datedenaissanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, datedenaissance ::class);
    }

    // /**
    //  * @return Date[] Returns an array of Date objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Date
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

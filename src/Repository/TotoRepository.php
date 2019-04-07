<?php

namespace App\Repository;

use App\Entity\Toto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Toto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toto[]    findAll()
 * @method Toto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Toto::class);
    }

    // /**
    //  * @return Toto[] Returns an array of Toto objects
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
    public function findOneBySomeField($value): ?Toto
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

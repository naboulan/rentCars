<?php

namespace App\Repository;

use App\Entity\Adel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adel[]    findAll()
 * @method Adel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adel::class);
    }

    // /**
    //  * @return Adel[] Returns an array of Adel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adel
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

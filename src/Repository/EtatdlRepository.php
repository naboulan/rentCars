<?php

namespace App\Repository;

use App\Entity\Etatdl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etatdl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etatdl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etatdl[]    findAll()
 * @method Etatdl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatdlRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Etatdl::class);
    }

    // /**
    //  * @return Etatdl[] Returns an array of Etatdl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etatdl
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

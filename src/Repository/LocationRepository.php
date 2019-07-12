<?php

namespace App\Repository;

use App\Entity\location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, location::class);
    }

    public function findByLocationInProgress($prop) 
    {
        $now = new \Datetime();

        $query= $this->createQueryBuilder('l')
        ->join('l.Car', 'c', 'WITH','l.Car = c.id')
        ->Where('c.user = :prop')
        ->setParameter('prop', $prop)
        ->andWhere('l.datedebut <= :now')
        ->andWhere('l.datefin >= :now')
        ->setParameter('now', $now)
        ->orderBy('l.datefin','DESC');

        return $query->getQuery()->getResult();
    
                  


    }
    public function findByLocationValid($prop) 
    {
         $now = new \Datetime();

        $query= $this->createQueryBuilder('l')
         ->join('l.Car', 'c', 'WITH','l.Car = c.id')
        ->Where('c.user = :prop')
        ->setParameter('prop', $prop)
        ->andWhere('l.datedebut >= :now')
        ->setParameter('now', $now)
        ->andWhere('l.validateProp = 1')
        ->orderBy('l.datedebut','ASC');

        return $query->getQuery()->getResult();
    
                  


    }
    public function findByLocationHistory($prop) 
    {
         $now = new \Datetime();

        $query= $this->createQueryBuilder('l')
        ->join('l.Car', 'c', 'WITH','l.Car = c.id')
        ->Where('c.user = :prop')
        ->setParameter('prop', $prop)
        ->andWhere('l.datefin < :now')
        ->setParameter('now', $now)
        ->orderBy('l.id','DESC');
        return $query->getQuery()->getResult();
    
                  


    }

    // /**
    //  * @return Location[] Returns an array of Location objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Location
    {
        return $this->createQueryBuilder('u')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

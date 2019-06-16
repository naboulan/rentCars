<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\User;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Car::class);
    }

    

    // /**
    //  * @return Car[] Returns an array of Car objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
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
    public function findOneBySomeField($value): ?Car
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function searchBy(array $filters )
    { 
        return $this->createQueryBuilder('c')
        ->join('c.user', 'u', 'WITH', 'c.user = u.id')
       // ->join('c.location', 'l', 'WITH', 'c.location = l.id')   ,'l.datedebut > datef','l.datefin < dated'
        ->andWhere( 'u.ville like :city')
        ->setParameter('city', '%'.$filters['city'].'%')
        ->getQuery()
        ->getResult();
    
    
    } 
    public function findlate():array
    { 
        return $this->createQueryBuilder('c')
        ->join('c.user', 'u', 'WITH', 'c.user = u.id')
       // ->join('c.location', 'l', 'WITH', 'c.location = l.id')   ,'l.datedebut > datef','l.datefin < dated'
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    
    
    } 
 }



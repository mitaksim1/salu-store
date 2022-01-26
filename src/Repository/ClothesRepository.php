<?php

namespace App\Repository;

use App\Entity\Clothes;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Clothes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clothes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clothes[]    findAll()
 * @method Clothes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clothes::class);
    }

    /**
     * Retourne la requête de tous les articles non vendus
     *
     * @return Query
     */
    public function findAllClothesNotSoldRequest(): Query
    {
        return $this->findAllClothesNotSoldQuery()
                ->getQuery();
    }

    /**
     * Retourne un tableau des 4 derniers articles
     * 
     * @return Clothes[]
     */
    public function findLatest()
    {
        return $this->findAllClothesNotSoldQuery()
                ->setMaxResults(4)
                ->getQuery()
                ->getResult(); 
    }

    /**
     * Request all not sold clothes
     */
    private function findAllClothesNotSoldQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
                ->where('c.isSold = false');
    }


    // /**
    //  * @return Clothes[] Returns an array of Clothes objects
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
    public function findOneBySomeField($value): ?Clothes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\PantryItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PantryItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method PantryItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method PantryItem[]    findAll()
 * @method PantryItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PantryItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PantryItem::class);
    }

    // /**
    //  * @return PantryItem[] Returns an array of PantryItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PantryItem
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

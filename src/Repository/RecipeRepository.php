<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }


    /**
     * Fetch Recipes for a category
     * @param $value
     * @return mixed
     */
    public function getRecipesByCategory($value)
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->andWhere('r.categoryId = :val')
            ->setParameter('val', $value)
            ->orderBy('r.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Fetch all recipes for a user
     * @param $value
     * @return mixed
     */
    public function getRecipesByUser($value)
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->andWhere('r.userId = :val')
            ->setParameter('val', $value)
            ->orderBy('r.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}

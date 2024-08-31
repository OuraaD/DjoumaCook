<?php

// namespace App\Repository;

// use App\Entity\Recipe;
// use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Persistence\ManagerRegistry;

// /**
//  * @extends ServiceEntityRepository<Recipe>
//  */
// class RecipeRepository extends ServiceEntityRepository
// {
//     public function __construct(ManagerRegistry $registry)
//     {
//         parent::__construct($registry, Recipe::class);
//     }

//     //    /**
//     //     * @return Recipe[] Returns an array of Recipe objects
//     //     */
//     //    public function findByExampleField($value): array
//     //    {
//     //        return $this->createQueryBuilder('r')
//     //            ->andWhere('r.exampleField = :val')
//     //            ->setParameter('val', $value)
//     //            ->orderBy('r.id', 'ASC')
//     //            ->setMaxResults(10)
//     //            ->getQuery()
//     //            ->getResult()
//     //        ;
//     //    }

//     //    public function findOneBySomeField($value): ?Recipe
//     //    {
//     //        return $this->createQueryBuilder('r')
//     //            ->andWhere('r.exampleField = :val')
//     //            ->setParameter('val', $value)
//     //            ->getQuery()
//     //            ->getOneOrNullResult()
//     //        ;
//     //    }
// }


namespace App\Repository;

use App\Entity\Recipe;
use App\Data\RecipeSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findBySearch(RecipeSearchData $search): array
    {
        $query = $this->createQueryBuilder('r');

        if ($search->Time) {
            $query->andWhere('r.time <= :Time')
                  ->setParameter('Time', $search->Time);
        }

     

        if ($search->People) {
            $query->andWhere('r.nbPeople <= :People')
                  ->setParameter('People', $search->People);
        }

        

        if ($search->Difficulty) {
            $query->andWhere('r.difficulty <= :Difficulty')
                  ->setParameter('Difficulty', $search->Difficulty);
        }

       
        if ($search->Price) {
            $query->andWhere('r.price <= :Price')
                  ->setParameter('Price', $search->Price);
        }

      
        if (!empty($search->ingredients)) {
            $query->andWhere(':ingredients MEMBER OF r.ingredients')
                  ->setParameter('ingredients', $search->ingredients);
        }

        return $query->getQuery()->getResult();
    }

    // Vous pouvez garder les méthodes commentées si vous pensez les utiliser plus tard

    //    /**
    //     * @return Recipe[] Returns an array of Recipe objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Recipe
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
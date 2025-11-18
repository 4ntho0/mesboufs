<?php

namespace App\Repository;

use App\Entity\CategorieRepa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieRepa>
 */
class CategorieRepaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRepa::class);
    }

     /**
     * Supprime une catégorie de repa
     * @param CategorieRepa $categorieRepa
     * @return void
     */
    public function remove(CategorieRepa $categorieRepa): void
    {
        $this->getEntityManager()->remove($categorieRepa);
        $this->getEntityManager()->flush();
    }    

    /**
     * Ajoute un environnement
     * @param CategorieRepa $categorieRepa
     * @return void
     */
    public function add(CategorieRepa $categorieRepa): void
    {
        $this->getEntityManager()->persist($categorieRepa);
        $this->getEntityManager()->flush();
    }
}

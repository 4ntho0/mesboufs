<?php

namespace App\Repository;

use App\Entity\CategorieAliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieAliment>
 */
class CategorieAlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieAliment::class);
    }

     /**
     * Supprime une catégorie d'aliment
     * @param CategorieAliment $categoriAliment
     * @return void
     */
    public function remove(CategorieAliment $categoriAliment): void
    {
        $this->getEntityManager()->remove($categoriAliment);
        $this->getEntityManager()->flush();
    }    

    /**
     * Ajoute un environnement
     * @param CategorieAliment $categoriAliment
     * @return void
     */
    public function add(CategorieAliment $categoriAliment): void
    {
        $this->getEntityManager()->persist($categoriAliment);
        $this->getEntityManager()->flush();
    }
    
    /**
 * Retourne la liste des catégories de repas d'une playlist
 * @param int $idPlaylist
 * @return CategorieRepa[]
 */
public function findAllForOnePlaylist(int $idPlaylist): array
{
    return $this->createQueryBuilder('c')
        ->join('c.formations', 'f')   // 'formations' doit être la relation dans CategorieRepa
        ->join('f.playlist', 'p')
        ->where('p.id = :id')
        ->setParameter('id', $idPlaylist)
        ->orderBy('c.nom', 'ASC')
        ->getQuery()
        ->getResult();
}
}

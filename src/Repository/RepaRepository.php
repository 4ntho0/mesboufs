<?php

namespace App\Repository;

use App\Entity\Repa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Repa>
 */
class RepaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repa::class);
    }

    /**
     * Retourne toutes les visites triées sur un champ
     * @param type $champ
     * @param type $ordre
     * @return Repa[]
     */
    public function findAllOrderBy($champ, $ordre): array{
        return $this->createQueryBuilder('v')
                ->orderBy('v.'.$champ, $ordre)
                ->getQuery()
                ->getResult();
    }
    
     /**
     * Supprime un repa
     * @param Repa $repa
     * @return void
     */
    public function remove(Repa $repa): void
    {
        $this->getEntityManager()->remove($repa);
        $this->getEntityManager()->flush();
    }    
    
    /**
     * Ajoute ou modifie un repa
     * @param Repa $repa
     * @return void
     */
    public function add(Repa $repa):void{
        
        $this->getEntityManager()->persist($repa);
        $this->getEntityManager()->flush();
    }
}

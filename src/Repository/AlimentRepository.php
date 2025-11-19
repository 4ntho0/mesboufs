<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aliment>
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    /**
     * Supprime un aliment
     * @param Aliment $aliment
     * @return void
     */
    public function remove(Aliment $aliment): void
    {
        $this->getEntityManager()->remove($aliment);
        $this->getEntityManager()->flush();
    }    

    /**
     * Ajoute un aliment
     * @param Aliment $aliment
     * @return void
     */
    public function add(Aliment $aliment): void
    {
        $this->getEntityManager()->persist($aliment);
        $this->getEntityManager()->flush();
    }
    
    /**
     * Retourne toutes les visites triées sur un champ
     * @param type $champ
     * @param type $ordre
     * @return Aliment[]
     */
    public function findAllOrderBy($champ, $ordre): array{
        return $this->createQueryBuilder('v')
                ->orderBy('v.'.$champ, $ordre)
                ->getQuery()
                ->getResult();
    }
}

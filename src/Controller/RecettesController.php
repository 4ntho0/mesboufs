<?php


namespace App\Controller;

use App\Repository\RepaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
/**
 * Description of RecettesController
 *
 * @author 4lfred 
 */
class RecettesController extends AbstractController{
    
    /**
     * 
     * @var RepaRepository
     */
    private $repository;
    
    /**
     * 
     * @param RepaRepository $repository
     */
    public function __construct(RepaRepository $repository) {
        $this->repository = $repository;
    }

    
     #[Route('/recettes', name: 'recettes')]
    public function index(): Response {
        $repas = $this->repository->findAllOrderBy('datecreation','DESC');
        return $this->render("pages/recettes.html.twig", [
            'repas' => $repas
        ]);
    }
    
     #[Route('/recettes/tri/{champ}/{ordre}', name: 'recettes.sort')]
    public function sort($champ, $ordre): Response{
        $repas = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render("pages/recettes.html.twig", [
            'repas' => $repas
        ]);
    }
    
    #[Route('/recettes/recette/{id}', name: 'recettes.showone')]
    public function showOne($id): Response{
        $repa = $this->repository->find($id);
        return $this->render("pages/recette.html.twig", [
            'repa' => $repa
        ]);
    }
    
}
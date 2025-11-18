<?php


namespace App\Controller\admin;

use App\Entity\CategorieRepa;
use App\Repository\CategorieRepaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminCategorieRepaController
 *
 * @author 4lfred 
 */
class AdminCategorieRepaController extends AbstractController{
    /**
     * 
     * @var CategorieRepa
     */
    private $repository;
    
    /**
     * 
     * @param CategorieRepaRepository $repository
     */
    public function __construct(CategorieRepaRepository $repository) {
        $this->repository = $repository;
    }
    
    #[Route('/admin/categoriesrepa', name: 'admin.categoriesRepa')]
    public function index(): Response {
        $categoriesRepa = $this->repository->findAll();
        return $this->render("admin/admin.categories.repa.html.twig", [
            'categoriesRepa' => $categoriesRepa
        ]);
    }   
    
    #[Route('/admin/categorierepa/suppr/{id}', name: 'admin.categorieRepa.suppr')]
    public function suppr(int $id): Response{
        $categorieRepa = $this->repository->find($id);
        $this->repository->remove($categorieRepa);
        return $this->redirectToRoute('admin.categoriesRepa');
    }
    
    #[Route('/admin/categorierepa/ajout', name: 'admin.categorieRepa.ajout')]
    public function ajout(Request $request): Response{
        $nomCategorieRepa = $request->get("nom");
        $categorieRepa = new CategorieRepa();
        $categorieRepa->setNom($nomCategorieRepa);
        $this->repository->add($categorieRepa);
        return $this->redirectToRoute('admin.categoriesRepa');
    }
}

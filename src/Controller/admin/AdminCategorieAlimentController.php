<?php



namespace App\Controller\admin;

use App\Entity\CategorieAliment;
use App\Repository\CategorieAlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminCategorieAlimentController
 *
 * @author 4lfred 
 */
class AdminCategorieAlimentController extends AbstractController{
    /**
     * 
     * @var CategorieAliment
     */
    private $repository;
    
    /**
     * 
     * @param CategorieAlimentRepository $repository
     */
    public function __construct(CategorieAlimentRepository $repository) {
        $this->repository = $repository;
    }
    
    #[Route('/admin/categoriesaliment', name: 'admin.categoriesAliment')]
    public function index(): Response {
        $categoriesAliment = $this->repository->findAll();
        return $this->render("admin/admin.categories.aliment.html.twig", [
            'categoriesAliment' => $categoriesAliment
        ]);
    }   
    
    #[Route('/admin/categoriealiment/suppr/{id}', name: 'admin.categorieAliment.suppr')]
    public function suppr(int $id): Response{
        $categorieAliment = $this->repository->find($id);
        $this->repository->remove($categorieAliment);
        return $this->redirectToRoute('admin.categorieAliment');
    }
    
    #[Route('/admin/categoriealiment/ajout', name: 'admin.categorieAliment.ajout')]
    public function ajout(Request $request): Response{
        $nomCategorieAliment = $request->get("nom");
        $categorieAliment = new CategorieAliment();
        $categorieAliment->setNom($nomCategorieAliment);
        $this->repository->add($categorieAliment);
        return $this->redirectToRoute('admin.categoriesAliment');
    }
}


<?php



namespace App\Controller\admin;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminAlimentController
 *
 * @author 4lfred 
 */
class AdminAlimentController extends AbstractController{
    /**
     * 
     * @var Aliment
     */
    private $repository;
    
    /**
     * 
     * @param AlimentRepository $repository
     */
    public function __construct(AlimentRepository $repository) {
        $this->repository = $repository;
    }
    
    #[Route('/admin/aliments', name: 'admin.aliments')]
    public function index(): Response {
        $aliments = $this->repository->findAll();
        return $this->render("admin/admin.aliments.html.twig", [
            'aliments' => $aliments
        ]);
    }   
    
    #[Route('/admin/aliment/suppr/{id}', name: 'admin.aliment.suppr')]
    public function suppr(int $id): Response{
        $aliment = $this->repository->find($id);
        $this->repository->remove($aliment);
        return $this->redirectToRoute('admin.aliments');
    }
    
    #[Route('/admin/aliment/ajout', name: 'admin.aliment.ajout')]
    public function ajout(Request $request): Response{
        $nomAliment = $request->get("nom");
        $uniteAliment = $request->get("unite");
        $categorieAliment = $request->get("categorie_id");
        $categorie = $categorieAliment->find($categorieAliment);
        
        $aliment = new Aliment();
        $aliment->setNom($nomAliment);
        $aliment->setUnite($uniteAliment);
        $aliment->setCategorie($categorie);
        $this->repository->add($aliment);
        return $this->redirectToRoute('admin.categoriesAliment');
    }
}

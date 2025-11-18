<?php



namespace App\Controller\admin;

use App\Entity\Repa;
use App\Form\RepaType;
use App\Repository\RepaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminRecettesController
 *
 * @author 4lfred 
 */
class AdminRecettesController extends AbstractController{
    
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
    
     #[Route('/admin', name: 'admin.recettes')]
    public function index(): Response {
        $repas = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.recettes.html.twig", [
            'repas' => $repas
        ]);
    }  
    
    #[Route('/admin/recettes/tri/{champ}/{ordre}', name: 'admin.recettes.sort')]
    public function sort($champ, $ordre): Response{
        $repas = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render("admin/admin.recettes.html.twig", [
            'repas' => $repas
        ]);
    }
    
      #[Route('/admin/suppr/{id}', name: 'admin.recette.suppr')]
    public function suppr(int $id): Response{
        $repa = $this->repository->find($id);
        $this->repository->remove($repa);
        return $this->redirectToRoute('admin.recettes');
    }
    
     #[Route('/admin/edit/{id}', name: 'admin.recette.edit')]
    public function edit(int $id, Request $request): Response{
        $repa = $this->repository->find($id);
        $formRepa = $this->createForm(RepaType::class, $repa);
        
         $formRepa->handleRequest($request);
        if($formRepa->isSubmitted() && $formRepa->isValid()){
            $this->repository->add($repa);
            return $this->redirectToRoute('admin.recettes');
        }
        
        return $this->render("admin/admin.recette.edit.html.twig", [
            'repa' => $repa,
            'formrepa' => $formRepa->createView() 
        ]);
    }
    
      #[Route('/admin/ajout', name: 'admin.recette.ajout')]
    public function ajout(Request $request): Response{
        $repa = new Repa();
        $formRepa = $this->createForm(RepaType::class, $repa);

        $formRepa->handleRequest($request);
        if($formRepa->isSubmitted() && $formRepa->isValid()){
            $this->repository->add($repa);
            return $this->redirectToRoute('admin.recettes');
        }

        return $this->render("admin/admin.recette.ajout.html.twig", [
            'repa' => $repa,
            'formrepa' => $formRepa->createView()
        ]);
    }
}

<?php

namespace App\Controller\admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
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
class AdminAlimentController extends AbstractController {

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
    public function index(Request $request): Response {
        $aliment = new Aliment();
        $formAliment = $this->createForm(AlimentType::class, $aliment);
        $formAliment->handleRequest($request);

        if ($formAliment->isSubmitted() && $formAliment->isValid()) {
            $this->repository->add($aliment);
            return $this->redirectToRoute('admin.aliments');
        }

        $aliments = $this->repository->findAllOrderBy('nom', 'ASC');

        return $this->render("admin/admin.aliments.html.twig", [
                    'aliments' => $aliments,
                    'formAliment' => $formAliment->createView()
        ]);
    }
    
    

    #[Route('/admin/aliment/suppr/{id}', name: 'admin.aliment.suppr')]
    public function suppr(int $id): Response {
        $aliment = $this->repository->find($id);
        $this->repository->remove($aliment);
        return $this->redirectToRoute('admin.aliments');
    }
}

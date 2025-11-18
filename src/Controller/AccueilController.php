<?php

namespace App\Controller;


use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Description of AccueilController
 *
 * @author 4lfred 
 */
class AccueilController extends AbstractController{
     #[Route('/', name: 'accueil')]
    public function index(): Response {
        
        return $this->render("pages/accueil.html.twig", 
            
        );
    }
}

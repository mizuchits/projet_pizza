<?php

namespace App\Controller;

use App\Form\NewPizzaType;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    

    public function index(PizzaRepository $repo): Response
    {
        $pizza = $repo->findAll();
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'pizza'=> $pizza,
            
        ]);
    }
    
}

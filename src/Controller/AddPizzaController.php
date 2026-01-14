<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\NewPizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AddPizzaController extends AbstractController
{
    #[Route('/add/pizza', name: 'app_add_pizza')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $pizza = new Pizza();

        $form = $this->createForm(NewPizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $entityManager->persist($pizza);
            $entityManager->flush();
            $this->addFlash('success','Article ajouté avec succès !');
            return $this->redirectToRoute('app_index');
        
        }


        return $this->render('add_pizza/index.html.twig', [
            'controller_name' => 'AddPizzaController',
            'NewPizza'=>$form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\NewPizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EditPizzaController extends AbstractController
{
    #[Route('/edit/pizza{id}', name: 'app_edit_pizza')]
    public function index(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(NewPizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pizza);
            $entityManager->flush();
            $this->addFlash('success','Article Supprimé avec succès !');
            return $this->redirectToRoute('app_index');
        
        }

        return $this->render('edit_pizza/index.html.twig', [
            'controller_name' => 'EditPizzaController',
            'NewPizza'=>$form->createView(),
        ]);
    }
}

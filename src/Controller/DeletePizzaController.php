<?php

namespace App\Controller;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DeletePizzaController extends AbstractController
{
    #[Route('/delete/pizza/{id}', name: 'app_delete_pizza')]
    public function delete(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid("SUP". $pizza->getId(),$request->get('_token'))){
            $entityManager->remove($pizza);
            $entityManager->flush();
            $this->addFlash('success','Article supprimé avec succès !');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('delete_pizza/index.html.twig', [
            'controller_name' => 'DeletePizzaController',
        ]);
    }
}

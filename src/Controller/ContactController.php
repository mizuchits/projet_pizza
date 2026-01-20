<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {

            $form = $this->createForm(ContactType::class);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $email = (new Email())
                ->from($data['email'])
                ->to('1@1.com')
                ->subject('Nouveau message de contact')
                ->text(
                    "nom: [{$data['name']}]\n".
                    "email: [{$data['email']}]\n\n".
                    "Message:\n{$data['message']}"
                );
                $mailer->send($email);
                return $this->redirectToRoute('app_index');
                }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'Contact'=>$form->createView(),
        ]);
    }
}

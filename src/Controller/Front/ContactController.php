<?php
namespace App\Controller\Front;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

      #[Route('/contact', name:'contact_index')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();

 
            $email = (new Email())
                ->from($data['email'])
                ->to('djooumacook@gmail.com') 
                ->subject('Nouveau message de contact')
                ->text("Nom: {$data['name']}\nEmail: {$data['email']}\nMessage: {$data['message']}");

            $mailer->send($email);

           
            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('home_index');
        }

        return $this->render('front/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

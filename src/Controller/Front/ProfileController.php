<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function index(): Response
    {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

       
        $user = $this->getUser();

        return $this->render('front/profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}

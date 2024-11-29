<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    
    #[Route('/front/legal', name: 'mentionsLegales_index')]
    public function mentionsLegales(): Response
    {
        return $this->render('front/legal/index.html.twig');
    }

    #[Route('/front/confidentialite', name: 'legal_confidentialite')]
    
    public function politiqueDeConfidentialite(): Response
    {
        return $this->render('front/legal/confidentialite.html.twig');
    }

    #[Route('/front/cookies', name: 'legal_cookies')]
    public function cookies(): Response
    {
        return $this->render('front/legal/cookies.html.twig');
    }
}

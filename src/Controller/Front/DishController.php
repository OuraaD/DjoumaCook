<?php

namespace App\Controller\Front;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DishController extends AbstractController
{
    #[Route('/front/dish', name: 'dish_index')]
    public function index(RecipeRepository $repository): Response
    {
        $recipes = $repository->findAll();

        return $this->render('front/dish/index.html.twig', [
            'recipe' => $recipes,
        ]);
    }
}



<?php

namespace App\Controller\Front;

use App\Data\RecipeSearchData;
use App\Form\RecipeSearchType;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipes', name: 'recipe_index')]
    public function index(Request $request, RecipeRepository $recipeRepository): Response
    {
        $searchData = new RecipeSearchData();
        $form = $this->createForm(RecipeSearchType::class, $searchData);
        $form->handleRequest($request);

        $recipes = $recipeRepository->findBySearch($searchData);

        return $this->render('front/recipe/index.html.twig', [
            'form' => $form->createView(),
            'recipes' => $recipes,
        ]);
    }
}
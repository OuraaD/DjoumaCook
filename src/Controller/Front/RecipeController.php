<?php

namespace App\Controller\Front;

use App\Data\RecipeSearchData;
use App\Entity\Recipe;
use App\Form\RecipeSearchType;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/front/recipes', name: 'recipe_index')]
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

    #[Route('/detail/{slug}', name: 'recipe_show',  methods: ['GET'])]
    public function show(Recipe $recipe): Response
    {
        return $this->render('front/recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
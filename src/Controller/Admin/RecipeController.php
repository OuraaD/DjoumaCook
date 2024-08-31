<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// #[IsGranted('ROLE_ADMIN')]
#[Route('/admin/recette', name: 'admin_recipe_')]
class RecipeController extends AbstractController
{

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(RecipeRepository $repository): Response
    {
        $recipes = $repository->findAll();

        return $this->render('admin/recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/detail/{slug}', name: 'show',  methods: ['GET'])]
    public function show(Recipe $recipe): Response
    {
        return $this->render('admin/recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/ajouter', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('thumbnailFile')->getData();

            if ($file) {
                $filedir = $this->getParameter('kernel.project_dir') . '/public/img/thumbnails';
                $fileName = $recipe->getSlug() . '.' . $file->getClientOriginalExtension();
                $file->move($filedir, $fileName);
                $recipe->setFileName($fileName);
            }

            $em->persist($recipe);
            $em->flush();

            $this->addFlash('success', 'La recette a bien été créée');

            return $this->redirectToRoute('admin_recipe_index');
        }

        return $this->render('admin/recipe/new.html.twig', [
            'recipe_form' => $form,
        ]);
    }

    #[Route('/modifier/{slug}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(EntityManagerInterface $em, Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('thumbnailFile')->getData();

            if ($file) {
                $filedir = $this->getParameter('kernel.project_dir') . '/public/img/thumbnails';
                $fileName = $recipe->getSlug() . '.' . $file->getClientOriginalExtension();
                $file->move($filedir, $fileName);
                $recipe->setFileName($fileName);
            }

            $em->flush();

            $this->addFlash('success', 'La recette a bien été modifiée');

            return $this->redirectToRoute('admin_recipe_index');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'recipe_form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, Recipe $recipe): Response
    {
        $em->remove($recipe);
        $em->flush();

        $this->addFlash('danger', 'La recette a été supprimée');

        return $this->redirectToRoute('admin_recipe_index');
    }
}

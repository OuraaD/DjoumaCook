<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// #[IsGranted('ROLE_ADMIN')]
#[Route('/admin/ingredient', name: 'admin_ingredient_')]
class IngredientController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(IngredientRepository $repository): Response
    {
        $ingredients = $repository->findAll();

        return $this->render('admin/ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }

    #[Route('/detail/{id}', name: 'show', methods: ['GET'])]
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('admin/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('/ajouter', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('thumbnailFile')->getData();

            if ($file) {
                $filedir = $this->getParameter('kernel.project_dir') . '/public/img/thumbnails';
                $fileName = $ingredient->getName() . '.' . $file->getClientOriginalExtension();
                $file->move($filedir, $fileName);
                $ingredient->setFileName($fileName);
            }

            $em->persist($ingredient);
            $em->flush();

            $this->addFlash('success', 'Un nouvel ingredient a été ajouté');

            return $this->redirectToRoute('admin_ingredient_index');
        }

        return $this->render('admin/ingredient/new.html.twig', [
            'ingredient_form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Ingredient $ingredient): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('thumbnailFile')->getData();

            if ($file) {
                $filedir = $this->getParameter('kernel.project_dir') . '/public/img/thumbnails';
                $fileName = $ingredient->getName() . '.' . $file->getClientOriginalExtension();
                $file->move($filedir, $fileName);
                $ingredient->setFileName($fileName);
            }

            $em->flush();

            $this->addFlash('success', 'Un nouvel ingredient a été ajouté');

            return $this->redirectToRoute('admin_ingredient_index');
        }

        return $this->render('admin/ingredient/new.html.twig', [
            'ingredient_form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, Ingredient $ingredient): Response
    {
        $em->remove($ingredient);
        $em->flush();

        $this->addFlash('danger', 'Un ingredient a été supprimé');

        return $this->redirectToRoute('admin_ingredient_index');
    }
}

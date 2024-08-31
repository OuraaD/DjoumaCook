<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeType extends AbstractType
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette'
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'required' => false,
            ])
            ->add('thumbnailFile', FileType::class, [
                'label' => 'Selectionner une image',
                'required' => false,
                'mapped' => false,
            ])
            ->add('time', IntegerType::class, [
                'label' => 'Durée de préparation',
                'required' => false,
            ])
            ->add('nbPeople', IntegerType::class, [
                'label' => 'Nombre de personnes',
                'required' => false,
            ])
            ->add('difficulty', RangeType::class, [
                'attr' => [
                    'id' => 'range'
                ],
                'label' => 'Difficulté',
                'label_attr' => [
                    'id' => 'output-value'
                ],
                'required' => false,
                'attr' => [
                    'min' => 1,
                    'max' => 6
                ]
            ])
            ->add('description')
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'scale' => 2
            ])
            ->add('isFavorite', CheckboxType::class, [
                'label' => 'Ajouter aux favoris',
                'required' => false,
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])->addEventListener(FormEvents::PRE_SUBMIT, $this->autoSlug(...));
    }

    public function autoSlug(PreSubmitEvent $event)
    {
        $data = $event->getData();
        if (empty($data['slug'])) {
            $slug = $this->slugger->slug($data['name'])->lower();
            $data['slug'] = $slug;
        }
        $event->setData($data);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}


<?php
namespace App\Form;

use App\Data\RecipeSearchData;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('name', TextType::class, [
            'required' => false,
            'label' => 'Nom de la recette',
            'attr' => [
                'placeholder' => 'Recherchez une recette...'
            ],
        ])
         
            ->add('People', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre de personnes'
            ])
        
            ->add('Difficulty', ChoiceType::class, [
                'required' => false,
                'label' => 'Difficulté',
                'choices' => [
                    'Très facile' => 1, 
                    'Facile' => 2,
                    'Moyen' => 3,
                    'Difficile' => 4,
                    'Très Difficile' =>5,
                    ],
                'placeholder' => 'Choisir une difficulté',
                'multiple' => false,
                'expanded' => false
            ]);
         
         
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeSearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
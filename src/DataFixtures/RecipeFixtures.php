<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(private SluggerInterface $slugger)
    {
        $this->faker = \Faker\Factory::create('fr_FR');
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        $this->faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->unique->foodName());
            $recipe->setSlug($this->slugger->slug($recipe->getName())->lower());
            $recipe->setFileName($this->faker->imageUrl(width: 800, height: 600));
            $recipe->setTime($this->faker->numberBetween(3, 100));
            $recipe->setNbPeople($this->faker->numberBetween(0, 50));
            $recipe->setDifficulty($this->faker->numberBetween(0, 6));
            $recipe->setDescription($this->faker->realText(200, 2));
            $recipe->setPrice($this->faker->randomFloat(2, 0, 100));
            $recipe->setIsFavorite($this->faker->boolean());
            for ($j = 0; $j < mt_rand(0, 6); $j++) {
                $recipe->addIngredient($this->getReference('INGREDIENT' . mt_rand(0, 19)));
            }
            $manager->persist($recipe);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [IngredientFixtures::class];
    }
}

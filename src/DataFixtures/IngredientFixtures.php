<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('fr_FR');
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        $this->faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word());
            $ingredient->setFileName($this->faker->imageUrl(width: 800, height: 600));
            $ingredient->setPrice($this->faker->randomFloat(2, 0, 20));
            $manager->persist($ingredient);
            $this->addReference('INGREDIENT' . $i, $ingredient);
        }

        $manager->flush();
    }
}

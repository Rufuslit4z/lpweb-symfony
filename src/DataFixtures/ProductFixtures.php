<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();   
        for($i = 0; $i < 10; $i++){
            $product = new Product();
            $product->setName($faker->name())
                ->setPrice($faker->randomNumber(2))
                ->setDescription($faker->text(3000))
                ->setCreatedAt($faker->dateTimeThisYear());
            $manager->persist($product);
        }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Pets;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class PetsFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 60; $i++) {
            $pets = new Pets();
            $pets->setName($this->faker->lastName());
            $pets->setRegistryNumber($this->faker->randomNumber(5, true) . '' . substr($this->faker->text(5), 1));
            $pets->setDescription($this->faker->text());
            $pets->setSexe(mt_rand(0, 1));
            $pets->setAge(mt_rand(1, 12));
            $pets->setArrivedAtRefuge(new DateTime());
            $pets->setIsVaccinated(mt_rand(0, 1));
            $pets->setIsSterilized(mt_rand(0, 1));
            $pets->setIsAffinityCat(mt_rand(0, 1));
            $pets->setIsAffinityDog(mt_rand(0, 1));
            $pets->setIsAffinityChildren(mt_rand(0, 1));
            $manager->persist($pets);
            $manager->flush();
        }
    }
}

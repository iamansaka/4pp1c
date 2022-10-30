<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class Partners extends Fixture
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
        for ($i = 0; $i < 25; $i++) {
            $partner = new Partner();
            $partner->setName($this->faker->company());
            $partner->setPicture("https://loremflickr.com/320/240/dog");
            $partner->setRepresentativeName($this->faker->lastName() . ' ' . $this->faker->firstName());
            $partner->setRepresentativeMail($this->faker->lastName() . '@gmail.com');
            $partner->setRepresentativePhone($this->faker->phoneNumber());
            $partner->setAdress($this->faker->streetAddress());
            $manager->persist($partner);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Testimonials as EntityTestimonials;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class Testimonials extends Fixture
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

        for ($i = 0; $i < 40; $i++) {
            $testimonial = new EntityTestimonials();
            $testimonial->setName($this->faker->lastName() . ' ' . $this->faker->firstName());
            $testimonial->setEmail($this->faker->lastName() . '@gmail.com');
            $testimonial->setRating(mt_rand(0, 5));
            $testimonial->setContent($this->faker->paragraph());
            $testimonial->setAnonyme(mt_rand(0, 1));
            $manager->persist($testimonial);
        }

        $manager->flush();
    }
}

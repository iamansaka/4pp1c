<?php

namespace App\DataFixtures;

use App\Entity\MemberShip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class MemberShipFixtures extends Fixture
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

        for ($i = 0; $i < 30; $i++) {
            $member = new MemberShip();
            $member->setFirstname($this->faker->firstName());
            $member->setLastname($this->faker->lastName());
            $member->setGender(mt_rand(0, 1));
            $member->setAge(mt_rand(19, 60));
            $member->setMail($this->faker->lastName() . "@gmail.com");
            $member->setPhone($this->faker->phoneNumber());
            $member->setAdress($this->faker->streetAddress());
            $member->setZipCode($this->faker->postcode());
            $member->setCity($this->faker->city());
            $manager->persist($member);
        }

        $manager->flush();
    }
}

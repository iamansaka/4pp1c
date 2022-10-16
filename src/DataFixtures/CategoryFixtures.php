<?php

namespace App\DataFixtures;

use App\Entity\Category as EntityCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // for ($i = 0; $i < 5; $i++) {
        //     $category = new EntityCategory();
        //     $category->setName("Cat" + $i);
        //     $manager->persist($category);
        // }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Article as EntityArticle;
use App\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class Article extends Fixture
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
        $categories = [];

        for ($j = 0; $j < 5; $j++) {
            $category = new Category();
            $category->setName("Cat $j");
            $categories[] = $category;
            $manager->persist($category);
        }


        for ($i = 0; $i < 100; $i++) {
            $article = new EntityArticle();
            $article->setTitle($this->faker->sentence());
            $article->setSlug((new Slugify())->slugify($article->getTitle()));
            $article->setSummary($this->faker->text());
            $article->setContent($this->faker->paragraphs(mt_rand(5, 15), true));
            $article->setIsPublished(mt_rand(0, 1));
            $article->setCategory($categories[mt_rand(0, 4)]);
            $manager->persist($article);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;


class ArticleFixture extends Fixture
{
    
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        for ($i=1; $i <= 3 ; $i++) { 
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());
          $manager->persist($category);
          for ($j=1; $j <= mt_rand(4,6) ; $j++) { 
            $article = new Article();
            $article->setTitle($faker->sentence())
                    ->setContent($faker->paragraph())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);
                    $manager->persist($article);
                    for ($k=1; $k <= mt_rand(4,10) ; $k++) { 
                        $comment = new Comment();
                        $comment->setAuthor($faker->name)
                                ->setContent($faker->paragraph())
                                ->setCreatedAt(new \DateTime())
                                ->setArticle($article);
                                $manager->persist($comment);
                        }
                }
        }
       

        $manager->flush();
    }
}

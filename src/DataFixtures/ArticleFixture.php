<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle("titre de l'article")
                ->setContent("Contenu de l'article")
                ->setCreatedAt(new \DateTime());
        $manager->persist($article);

        $articleD = new Article(); 
        $articleD->setTitle("titre de l'article 2 ")
                ->setContent("Contenu de l'article 2")
                ->setCreatedAt(new \DateTime());
        $manager->persist($articleD);
       
        $manager->flush();
    }
}

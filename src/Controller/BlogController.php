<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;
use App\Form\CommentType;
use Doctrine\Common\Persistence\ObjectManager;

class BlogController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('blog/home.html.twig', [
            'articles' => $articles
        ]);
    }

 


}

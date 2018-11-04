<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentRepository;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;



class CommentController extends AbstractController
{
 
    /**
     * @Route("blog/comment/{id}", name="article_comment")
     */
    public function comment(Article $article,Request $request, ObjectManager $manager)
    {
        
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $comment->setArticle($article);
           $comment->setCreatedAt(new \DateTime());
        
           $manager->persist($comment);
           $manager->flush();

        return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/createComment.html.twig', [
            'formComment' => $form->createView(),
            'article' => $article
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @author marouane
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name = "front_index")
     */
    public function indexAction()
    {
        $articles = $this->get('front.article.manager')->getAll();

        return $this->render('article/index.html.twig', ['articles' => $articles]);
    }

    /**
     * get single article.
     *
     * @Route("/articles/{slug}", name = "front_get_article")
     * @Method({"GET"})
     */
    public function getAction(Request $request)
    {
        $article = $this->get('front.article.manager')->get($request->getPathInfo());

        return $this->render('article/article.html.twig', ['article' => $article]);
    }

    /**
     * Delete article.
     *
     * @Route("/articles/{slug}", name = "front_delete_article")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        $this->get('front.article.manager')->delete($request->getPathInfo());

        return $this->redirect($this->generateUrl('front_index'));
    }

    /**
     * Create new Article.
     *
     * @Route("/create", name = "front_create_article")
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(new ArticleType());

        return $this->render('article/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/post-form", name = "front_post_form_article")
     *
     * @param Request $request
     */
    public function postFormAction(Request $request)
    {
        $form = $this->createForm(new ArticleType());

        return $this->get('front.article.form_handler')->handle($form, $request);
    }
}

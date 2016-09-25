<?php

namespace AppBundle\Form\Handler;

use AppBundle\Manager\ArticleManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @author marouane
 */
class ArticleHandler
{
    /**
     * @var ArticleManagerInterface
     */
    private $articleManager;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @param ArticleManagerInterface $articleManager
     * @param FormFactoryInterface    $formFactory
     */
    public function __construct(ArticleManagerInterface $articleManager, UrlGeneratorInterface $router)
    {
        $this->articleManager = $articleManager;
        $this->router = $router;
    }

    /**
     * @param FormInterface $form
     * @param Request       $request
     *
     * @return RedirectResponse|FormInterface
     */
    public function handle(FormInterface $form, Request $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->articleManager->post($form->getData());
//            dump($this->router->generate('front_index'));die;
            return new RedirectResponse($this->router->generate('front_index'));
        }

//        return $form;
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LangueController extends AbstractController
{
    /**
     * @Route("/langue", name="langue")
     */
    public function index(): Response
    {
        return $this->render('langue/index.html.twig', [
            'controller_name' => 'LangueController',
        ]);
    }


    /**
     * @param $locale
     * @param Request $request
     * @return RedirectResponse
     * @Route("/langue/{locale}", name="langue")
     */
    public function langue($locale, Request $request)
    {
        $request->getSession()->set('_locale',$locale);
        //$request->setLocale($locale);
        return $this->redirect($request->headers->get('referer'));
    }
}

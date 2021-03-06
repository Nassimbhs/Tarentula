<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddproductController extends AbstractController
{
    /**
     * @Route("/addproduct", name="addproduct")
     */
    public function index(): Response
    {
        return $this->render('addproduct/index.html.twig', [
            'controller_name' => 'AddproductController',
        ]);
    }
}

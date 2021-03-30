<?php

namespace App\Controller;

use App\Entity\ProductSearch;
use App\Entity\Produit;
use App\Form\ProduitSearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_produit_")
 * @package App\Controller\
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $r = $this->getDoctrine()->getRepository(Produit::class);
        $product = $r->findAll();
        // Paginate the results of the query
        $products = $paginator->paginate(
        // Doctrine Query, not results
            $product,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );

        return $this->render('adminProduct/index.html.twig', [
            'controller_name' => 'ProduitController',
            'products' => $products,
        ]);
    }


}

<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/add_product")
     */
    public function add_product(Request $request)
    {
        $product = new Produit();
        $form = $this->createForm(ProduitType::class,$product);
        $form->add('Ajouter',SubmitType::class);
        $form ->handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()){
            $em = $this ->getDoctrine() ->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product');
        }
        return $this->render('addproduct/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/product", name="product")
     */
    public function readproduct()
    {
        $r=$this->getDoctrine()->getRepository(Produit::class);
        $product=$r->findAll();
        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }

}

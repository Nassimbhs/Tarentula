<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Form\CommandeType;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use mysql_xdevapi\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductauthController extends AbstractController
{
    /**
     * @Route("/productauth", name="index")
     */
    public function index(Request $request, PaginatorInterface $paginator, SessionInterface $session): Response
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

        return $this->render('productauth/index.html.twig', [
            'controller_name' => 'ProductauthController',
            'products' => $products,
        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="addpanier")
     */
    public function add(Request $request, SessionInterface $session, $id): Response
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');

    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(Request $request, SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantite) {
            $panierWithData[] = [
                'product' => $produitRepository->find($id),
                'quantite' => $quantite
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }
        return $this->render('productauth/panier.html.twig', [
            'controller_name' => 'ProductauthController',
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function commande(Request $request, SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantite) {
            $panierWithData[] = [
                'product' => $produitRepository->find($id),
                'quantite' => $quantite
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }
        $cmd = new Commande();
        $form1 = $this->createForm(CommandeType::class, $cmd);
        $form1->add('COMMANDER', SubmitType::class, [
            'attr' => ['class' => 'button button-sliding-icon ripple-effect'],]);
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach($panierWithData as $s) {
                $cmd->setCmd($s);
            }
            $em->persist($cmd);
            $em->persist($cmd);
            $em->flush();
            return $this->redirectToRoute('commande');
        }

            return $this->render('product/commande.html.twig', [
            'controller_name' => 'ProductauthController',
            'formc' => $form1->createView(),
            'items' => $panierWithData,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/panier/remove/{id}", name="removepanier")
     */
    public function remove(Request $request, SessionInterface $session, $id): Response
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('panier');
    }


}

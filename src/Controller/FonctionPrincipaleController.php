<?php

namespace App\Controller;

use App\Entity\FonctionPrincipale;
use App\Form\FonctionPrincipaleType;
use App\Repository\FonctionPrincipaleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fonction/principale")
 */
class FonctionPrincipaleController extends AbstractController
{
    /**
     * @var FonctionPrincipaleRepository
     */
    private $repository;

    public  function __construct(FonctionPrincipaleRepository$repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/search/",name="searchfonctionprincipale")
     */
    public function search(Request $request){
        $requestString= $request->get('q');
        $posts=$this->repository->findLike($requestString);
        if (!$posts){
            $result['posts']['error'] = 'Aucun  trouvé';
        }
        else{
            $result['posts']=$this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    /**
     * @Route("/searchAll/",name="searchAllfonctionprincipale")
     */
    public function searchAll(Request $request, PaginatorInterface $paginator){
        $properties=$this->repository->findAllLike($_POST['mot']);
        if (!isset($_POST['mot']))
            $properties=$this->repository->findAll();
        $blogs = $paginator->paginate(
        // Doctrine Query, not results
            $properties,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        return $this->render("fonction_principale/index.html.twig",[
            "fonction_principales"=>$blogs
        ]);
    }

    public function getRealEntities($posts){
        foreach($posts as $post){
            $realEntities[$post->getIdFonction()] = [$post->getNomFonction()];

        }
        return $realEntities;
    }
    /**
     * @Route("/", name="fonction_principale_index", methods={"GET"})
     */

    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $properties=$this->repository->findAll();
        $blogs = $paginator->paginate(
        // Doctrine Query, not results
            $properties,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        return $this->render('fonction_principale/index.html.twig', [
            'fonction_principales' => $blogs,
        ]);
    }

    /**
     * @Route("/new", name="fonction_principale_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fonctionPrincipale = new FonctionPrincipale();
        $form = $this->createForm(FonctionPrincipaleType::class, $fonctionPrincipale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fonctionPrincipale);
            $entityManager->flush();

            return $this->redirectToRoute('fonction_principale_index');
        }

        return $this->render('fonction_principale/new.html.twig', [
            'fonction_principale' => $fonctionPrincipale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFonction}", name="fonction_principale_show", methods={"GET"})
     */
    public function show(FonctionPrincipale $fonctionPrincipale): Response
    {
        return $this->render('fonction_principale/show.html.twig', [
            'fonction_principale' => $fonctionPrincipale,
        ]);
    }

    /**
     * @Route("/{idFonction}/edit", name="fonction_principale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FonctionPrincipale $fonctionPrincipale): Response
    {
        $form = $this->createForm(FonctionPrincipaleType::class, $fonctionPrincipale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fonction_principale_index');
        }

        return $this->render('fonction_principale/edit.html.twig', [
            'fonction_principale' => $fonctionPrincipale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFonction}", name="fonction_principale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FonctionPrincipale $fonctionPrincipale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fonctionPrincipale->getIdFonction(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fonctionPrincipale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fonction_principale_index');
    }
}

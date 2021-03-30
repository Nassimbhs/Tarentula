<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\Offre1Type;
use App\Repository\OffreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offre")
 */
class OffreController extends AbstractController
{
    /**
     * @var OffreRepository
     */
    private $repository;

    public  function __construct(OffreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/trier", name="offre_trie")
     */
    public function trier(OffreRepository $offreRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $offre=$offreRepository->findAll();
        if (isset($_POST['trie'])){
        if ($_POST['trie']=='DateCreation')
            $offre=$offreRepository->TrierParDateCreation();
        else if ($_POST['trie']=='disponibilite')
            $offre=$offreRepository->TrierParDisponiblite();
        else if ($_POST['trie']=='DateExpiration')
            $offre=$offreRepository->TrierParDateFin();
        }
        $pagination = $paginator->paginate(
            $offre, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('offre/index.html.twig', [
            'offres' => $pagination,
        ]);
    }

    /**
     * @Route("/search/",name="searchOffre")
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
     * @Route("/searchAll/",name="searchAllOffre")
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
        return $this->render("offre/index.html.twig",[
            "offres"=>$blogs
        ]);
    }

    public function getRealEntities($posts){
        foreach($posts as $post){
            $realEntities[$post->getNumoffre()] = [$post->getDisponibilite()];

        }
        return $realEntities;
    }
    /**
     * @Route("/", name="offre_index", methods={"GET"})
     */
    public function index(OffreRepository $offreRepository,  Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $offreRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('offre/index.html.twig', [
            'offres' => $pagination
        ]);
    }

    /**
     * @Route("/back", name="offre_index_back", methods={"GET"})
     * @param OffreRepository $offreRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index_back(OffreRepository $offreRepository,  Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $offreRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('offre/index_back.html.twig', [
            'offres' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offre = new Offre();
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numoffre}", name="offre_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/{numoffre}/edit", name="offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numoffre}", name="offre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offre $offre)
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getNumoffre(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index');
    }
}

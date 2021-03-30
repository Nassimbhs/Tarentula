<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Form\EmploiType;
use App\Repository\EmploiRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emploi")
 */
class EmploiController extends AbstractController
{
    /**
     * @var EmploiRepository
     */
    private $repository;

    public  function __construct(EmploiRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/search/",name="search")
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
     * @Route("/searchAll/",name="searchAll")
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
        return $this->render("emploi/index.html.twig",[
            "emplois"=>$blogs
        ]);
    }

    public function getRealEntities($posts){
        foreach($posts as $post){
            $realEntities[$post->getIdEmploi()] = [$post->getNomEmploi()];

        }
        return $realEntities;
    }

    /**
     * @Route("/", name="emploi_index", methods={"GET"})
     */
    public function index(EmploiRepository $emploiRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $emploiRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('emploi/index.html.twig', [
            'emplois' => $pagination,
        ]);
    }

    /**
     * @Route("/trier", name="emploi_trie")
     */
    public function trier(EmploiRepository $emploiRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $emplois=$emploiRepository->findAll();
        if (isset($_POST['trie'])) {
            if ($_POST['trie'] == 'nomEmploi')
                $emplois = $emploiRepository->TrierParNomEmploi();
            else if ($_POST['trie'] == 'disponibilite')
                $emplois = $emploiRepository->TrierParDisponiblite();
            else if ($_POST['trie'] == 'ageMin')
                $emplois = $emploiRepository->TrierParAgeMin();
            else if ($_POST['trie'] == 'ageMax')
                $emplois = $emploiRepository->TrierParAgeMax();
        }
        $pagination = $paginator->paginate(
            $emplois, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('emploi/index.html.twig', [
            'emplois' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="emploi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emploi = new Emploi();
        $form = $this->createForm(EmploiType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emploi);
            $entityManager->flush();

            return $this->redirectToRoute('emploi_index');
        }

        return $this->render('emploi/new.html.twig', [
            'emploi' => $emploi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEmploi}", name="emploi_show", methods={"GET"})
     */
    public function show(Emploi $emploi): Response
    {
        return $this->render('emploi/show.html.twig', [
            'emploi' => $emploi,
        ]);
    }

    /**
     * @Route("/{idEmploi}/edit", name="emploi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Emploi $emploi): Response
    {
        $form = $this->createForm(EmploiType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emploi_index');
        }

        return $this->render('emploi/edit.html.twig', [
            'emploi' => $emploi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEmploi}", name="emploi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Emploi $emploi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploi->getIdEmploi(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emploi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emploi_index');
    }
}

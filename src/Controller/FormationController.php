<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formation")
 */
class FormationController extends AbstractController
{
    /**
     * @var FormationRepository
     */
    private $repository;

    public  function __construct(FormationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/search/",name="searchformation")
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
     * @Route("/trier/",name="formation_trie")
     */
    public function trier(FormationRepository $formationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $formations=$formationRepository->findAll();
        if (isset($_POST['trie'])) {
            if ($_POST['trie'] == 'domaine')
                $formations = $formationRepository->TrierParDomaine();
            else if ($_POST['trie'] == 'duree')
                $formations  = $formationRepository->TrierParDuree();
            else if ($_POST['trie'] == 'lieu')
                $formations  = $formationRepository->TrierParLieu();

        }
        $pagination = $paginator->paginate(
            $formations, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('formation/index.html.twig', [
            'formations' => $pagination,
        ]);
    }

    /**
     * @Route("/searchAll/",name="searchAllformation")
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
        return $this->render("formation/index.html.twig",[
            "formations"=>$blogs
        ]);
    }

    public function getRealEntities($posts){
        foreach($posts as $post){
            $realEntities[$post->getIdFormation()] = [$post->getDomaine()];

        }
        return $realEntities;
    }
    /**
     * @Route("/", name="formation_index", methods={"GET"})
     */
    public function index(FormationRepository $formationRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $pagination = $paginator->paginate(
            $formationRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('formation/index.html.twig', [
            'formations' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('formation_index');
        }

        return $this->render('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFormation}", name="formation_show", methods={"GET"})
     */
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route("/{idFormation}/edit", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_index');
        }

        return $this->render('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFormation}", name="formation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getIdFormation(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_index');
    }
}

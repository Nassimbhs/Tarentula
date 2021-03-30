<?php

namespace App\Controller;

use App\Entity\District;
use App\Form\DistrictType;
use App\Repository\DistrictRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/district")
 */
class DistrictController extends AbstractController
{

    /**
     * @var DistrictRepository
     */
    private $repository;

    public  function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/search/",name="searchdistrict")
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
     * @Route("/searchAll/",name="searchAlldistrict")
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
        return $this->render("district/index.html.twig",[
            "districts"=>$blogs
        ]);
    }

    public function getRealEntities($posts){
        foreach($posts as $post){
            $realEntities[$post->getIdDistrict()] = [$post->getNomDistrict()];

        }
        return $realEntities;
    }

    /**
     * @Route("/", name="district_index", methods={"GET"})
     * @param DistrictRepository $districtRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(DistrictRepository $districtRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $districtRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('district/index.html.twig', [
            'districts' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="district_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $district = new District();
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($district);
            $entityManager->flush();

            return $this->redirectToRoute('district_index');
        }

        return $this->render('district/new.html.twig', [
            'district' => $district,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idDistrict}", name="district_show", methods={"GET"})
     */
    public function show(District $district): Response
    {
        return $this->render('district/show.html.twig', [
            'district' => $district,
        ]);
    }

    /**
     * @Route("/{idDistrict}/edit", name="district_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, District $district): Response
    {
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('district_index');
        }

        return $this->render('district/edit.html.twig', [
            'district' => $district,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idDistrict}", name="district_delete", methods={"DELETE"})
     */
    public function delete(Request $request, District $district): Response
    {
        if ($this->isCsrfTokenValid('delete'.$district->getIdDistrict(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($district);
            $entityManager->flush();
        }

        return $this->redirectToRoute('district_index');
    }
}

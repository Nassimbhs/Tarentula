<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function index(): Response
    {
        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }

    /**
     * @param EntrepriseRepository $repo
     * @return Response
     * @Route("/entrepriseAffiche", name="entrepriseAffiche")
     */
    public function liste(EntrepriseRepository $repo)
    {
        $entreprise = $repo->findAll();
        return $this->render('entreprise/Affiche.html.twig', [
            'personne' => $entreprise
        ]);
    }

    /**
     * @param $id
     * @param EntrepriseRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/entrepriseSupprime/{id}", name="entrepriseSupprime")
     */
    public function Supprimer($id, EntrepriseRepository $repository)
    {
        $entreprise = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($entreprise);
        $em->flush();
        return $this->redirectToRoute('entrepriseAffiche');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/entrepriseAjoute",name="entrepriseAjoute")
     */
    function Ajouter(Request $request)
    {
        $entreprise=new Entreprise();
        $form= $this->createForm(EntrepriseType::class,$entreprise);
        $form->add("Valider",SubmitType::class);//boutton formulaire
//le bouton avant le gestionnaire de requetes
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($entreprise);
            $em->flush();
            return $this->redirectToRoute('entrepriseAffiche');
        }
        return $this->render("entreprise/Ajouter.html.twig", [
            "form"=>$form->createView()
        ]);
    }

    /**
     * @param $id
     * @param EntrepriseRepository $repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/entrepriseUpdate/{id}", name="entrepriseUpdate")
     */
    public function Udpdate($id, EntrepriseRepository $repository,Request $request)
    {
        $entreprise = $repository->find($id);
        $form=$this->createForm(EntrepriseType::class,$entreprise);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('entrepriseAffiche');
        }
        return $this->render('entreprise/Update.html.twig',[

            'form'=>$form->createView() ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfilType;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @param ProfilRepository $repo
     * @return Response
     * @Route("/profileAffiche" ,name="profileAffiche")
     */
    public function liste(ProfilRepository $repo)
    {
        $profil = $repo->findAll();
        return $this->render('profil/Affiche.html.twig', [
            'profil' => $profil
        ]);
    }

    /**
     * @param $id
     * @param ProfilRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/profileSupprime/{id}", name="profileSupprime")
     */
    public function Supprimer($id, ProfilRepository $repository)
    {
        $profil = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($profil);
        $em->flush();
        return $this->redirectToRoute('profileAffiche');
    }

    /**
     * @param $id
     * @param ProfilRepository $repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/profileUpdate/{id}", name="profileUpdate")
     */
    public function Udpdate($id, ProfilRepository $repository,Request $request)
    {
        $profil = $repository->find($id);
        $form=$this->createForm(ProfilType::class,$profil);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('personne');
        }
        return $this->render('profil/Update.html.twig',[

        'form'=>$form->createView() ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/profileAjoute", name="profileAjoute")
     */
    function Ajouter(Request $request)
    {
        $profil=new Profil();
        $form= $this->createForm(ProfilType::class,$profil);
        $form->add("Valider",SubmitType::class);//boutton formulaire
//le bouton avant le gestionnaire de requetes
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush();
            return $this->redirectToRoute('profileAffiche');
        }
        return $this->render("profil/Ajouter.html.twig", [
            "form"=>$form->createView()
        ]);
    }


}

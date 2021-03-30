<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\Profil;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class PersonneController extends AbstractController
{
    /**
     * @Route("/personne1", name="personne1")
     */
    public function index1(): Response
    {
        return $this->render('personne/index1.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }

    /**
     * @return Response
     * @Route("/personne", name="personne")
     */
    public function index(): Response
    {
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }


    /**
     * @param PersonneRepository $repo
     * @param NormalizerInterface $normalizer
     * @return Response
     * @Route("/personneAffiche", name="personneAffiche")
     */
    public function liste(PersonneRepository $repo,NormalizerInterface $normalizer)
    {
        $personne = $repo->findAll();
       // $jsonContent=$normalizer->normalize($personne,'json',['groups'=>'Personne:read']);
        //var_dump($jsonContent);
        return $this->render('personne/Affiche.html.twig', [
            'data' => $personne
        ]);
    }

    /**
     * @param $id
     * @param PersonneRepository $repository
     * @return Response
     * @Route ("/AffichePerso/{id}", name="AffichePerso")
     */
    public function affichePerso($id, PersonneRepository $repository)
    {
        $personne = $repository->find($id);
        return $this->render('personne/AffichePerso.html.twig', [
            'p' => $personne
        ]);
    }

    /**
     * @param $id
     * @param PersonneRepository $repository
     * @return RedirectResponse
     * @Route ("/personneSupprime/{id}", name="s")
     */
    public function Supprimer($id, PersonneRepository $repository)
    {
        $personne = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($personne);
        $em->flush();
        return $this->redirectToRoute('personneAffiche');
    }


    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     * @Route("/personneAjoute",name="personneAjoute")
     */
    function Ajouter(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $perso=new Personne();
        $profil=new Profil();
        $profil->setPersonne($perso);
        $form= $this->createForm(PersonneType::class,$perso);
        $form->add("Valider",SubmitType::class);//boutton formulaire
//le bouton avant le gestionnaire de requetes
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $hash=$encoder->encodePassword($perso,$perso->getPassword());
            $perso->setPassword($hash);
            $em->persist($perso);
            $em->flush();
            $profil->setId($perso->getId());
            $em->persist($profil);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render("personne/Ajouter.html.twig", [
            //'username' => $perso->getUsername(),
            "form"=>$form->createView()
            ]);
    }

    /**
     * @param $id
     * @param PersonneRepository $repository
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/personneUpdate/{id}", name="personneUpdate")
     */
    public function Udpdate($id, PersonneRepository $repository,Request $request)
    {
        $perso = $repository->find($id);
        $form=$this->createForm(PersonneType::class,$perso);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('personneAffiche');
        }
        return $this->render('personne/Update.html.twig',[

            'form'=>$form->createView() ]);
    }

    /**
     * @param Request $request
     * @param NormalizerInterface $normalizer
     * @param PersonneRepository $rep
     * @return Response
     * @throws ExceptionInterface
     * @Route("/searchPersonnex ", name="searchPersonnex")
     */
    public function searchPersonnex(Request $request,NormalizerInterface $normalizer,PersonneRepository $rep)
    {
        $requestString =  $request->get('searchValue');
        $personne = $rep->findPersonneByNom($requestString);
        $jsonContent = $normalizer->normalize($personne, 'json',['groups'=>'post:read']);
        $retour= json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/login1", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('personne/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    /**
     * @return Response
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

    }



}

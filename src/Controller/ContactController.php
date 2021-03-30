<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\PersonneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @param $id
     * @param PersonneRepository $repository
     * @Route("/contact/{id}", name="contactMail")
     * @return Response
     */
    public function index($id,PersonneRepository $repository,Request $request, \Swift_Mailer $mailer): Response
    {
        $personne = $repository->find($id);
        $form= $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if( $form->isSubmitted() and $form->isValid())
        {
            $contact=$form->getData();
            /*ici nous enverrons le mail
            dd($contact);*/
            $contact['email']=$personne->getEmail();
            //ici nous enverrons le mail
            $message= (new \Swift_Message('Nouveau Contact'))

            //ici on attribue l'expediteur
             ->setFrom('Officium@gmail.com')

            //ici on attribue l'expediteur

            ->setTo($contact['email'])

                //ici on cree le message avec la vue
            ->setBody(
                $this->renderView(
                    'email/Contact.html.twig', [
                       'contact' => $contact
                    ]

                ),
                    'text/html'
                );

            //on envoie le message
            $mailer->send($message);
            $this->addFlash('message',"Le message a bien ete envoye");
            return $this->redirectToRoute('personneAffiche');



        }
        return $this->render('contact/index.html.twig', [
            'contactform' => $form->createView(),
        ]);
    }
}

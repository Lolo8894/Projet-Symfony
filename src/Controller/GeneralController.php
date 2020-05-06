<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class GeneralController extends AbstractController
{
    /**
     * @Route("/accueil", name="general_accueil")
     */
    public function accueil() {

        return $this->render('general/accueil.html.twig', [
            'title' => "Les créations de Lyline",
        ]);
    }

    /**
     * @Route("/mes_creations", name="general_mes_creations")
     */
    public function mesCreations() { // /mes_creations c'est l'URL et name est le nom de la route quand on l'appelle
        return $this->render('general/mes_creations.html.twig', [
            'title' => "Les créations de Lyline",
        ]);
    }

     /**
     * @Route("/a_propos", name="general_a_propos")
     */
    public function aPropos() {

        return $this->render('general/general_a_propos.html.twig', [
            'title' => "Les créations de Lyline",
        ]);
    }

    /**
     * @Route("/contact", name="contact", methods={"POST", "GET"})
     */
    public function contact(MailerInterface $mailer, Request $request) {

        $contact = new Contact(); // En lien avec l'entité Contact

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

          // dd($contact) // pour s'assurer de la récolte des informations du formulaire aid au développeur

          // On met les informations dans la base de données
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($contact);
          $entityManager->flush();

          // Ici nous enverrons l'e-mail

            $email = (new Email())
          // on attribue l'expéditeur
          ->from('c7e007bfa9-811903@inbox.mailtrap.io')
          // on attribue le destinataire
          ->to($contact->getEmail())
          // on crée le message
          ->subject('Un message du site Les créations de Lyline')
          ->text("{$contact->getContent()}" )
          ->html("<h1>{$contact->getContent()}<h1>" );

        // on envoie le message
        $mailer->send($email);

        $this->addFlash('message', "Votre message a été transmis, merci de m'avoir contacté !"); // Permet un message flash de renvoi, ce message apparaît dans easyadmin

        // on redirige vers la page de confirmation d'envoi de mail
        return $this->redirectToRoute('general_accueil');

        }
        return $this->render('general/accueil.html.twig',[
          'form' => $form->createView(),
        ]);
    }

}

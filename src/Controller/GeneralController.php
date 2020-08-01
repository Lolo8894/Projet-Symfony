<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Contact;
use App\Entity\Creations;
use App\Entity\Accueil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;


class GeneralController extends AbstractController
{

    /**
     * @Route("/", methods={"POST", "GET"})
     * @Route("/", name="general_accueil", methods={"POST", "GET"})
     */
//    public function accueil(Request $request, EntityManagerInterface $manager) { // "/" c'est l'URL et name est le nom de la route quand on l'appelle
//      
//        $repo = $this->getDoctrine()->getRepository(Accueil::class);
//
//        $home = $repo->findAll();
//        
//        return $this->render('general/accueil.html.twig', [
//            'title' => "Les créations de Lyline",
//            'home' => $home
//        ]);
//    }
  
    /**
     * @Route("/", methods={"POST", "GET"})
     * @Route("/", name="general_accueil", methods={"POST", "GET"})
     */
    public function contact(MailerInterface $mailer, Request $request) {

        $contact = new Contact(); // En lien avec l'entité Contact

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

          // dd($contact) // pour s'assurer de la récolte des informations du formulaire aide au développeur

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
          ->text("{$contact->getMessage()}" ) // Text brut sans images
          ->html("<h1>{$contact->getMessage()}</h1>" ); // Pour faire apparaître la config de l'UTF-8, fait apparaître les caractères spéciaux et images

        // on envoie le message
        $mailer->send($email);

        $this->addFlash('message', "Votre message a été transmis, merci de m'avoir contacté !"); // Permet un message flash de renvoi, ce message apparaît dans easyadmin

        // on redirige vers la page de confirmation d'envoi de mail
        return $this->redirectToRoute('general_accueil');

        }
      
       return $this->render(
         'general/accueil.html.twig', [
         'title' => 'Les créations de Lyline',
         'form'  => $form->createView(),
        ]);
      
        //return $this->render('general/accueil.html.twig',[
        //  'form'=> $form->createView(),
        //]);
    }


    /**
     * @Route("/mes_creations", name="general_mes_creations")
     */
    public function mesCreations(Request $request, EntityManagerInterface $manager) { // /mes_creations c'est l'URL et name est le nom de la route quand on l'appelle
      
        $repo = $this->getDoctrine()->getRepository(Creations::class);

        $creations = $repo->findAll();

        return $this->render('general/mes_creations.html.twig', [
            'title' => "Les créations de Lyline",
            'creations' => $creations
        ]);
    }
  
    /**
       * @Route("/description/{id}", name="description-creation")
       */
      public function description1($id) { 
        
          $repo = $this->getDoctrine()->getRepository(Creations::class);

          $creation = $repo->find($id);
        
          if ($creation === null) {
          Throw $this->createNotFoundException();
          }
        
          return $this->render('general/description1.html.twig', [
              'title' => "Les créations de Lyline",
              'creation' => $creation
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
     * @Route("/politique_de_confidentialite", name="politique_de_confidentialite")
     */
    public function politiqueConfidentialite() {

        return $this->render('general/politique_de_confidentialite.html.twig', [
            'title' => "Les créations de Lyline",
        ]);
    }
}
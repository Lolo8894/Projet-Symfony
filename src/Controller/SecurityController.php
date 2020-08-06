<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\InscriptionType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SecurityController extends AbstractController
{
  /**
  * @Route("/inscription", name="security_inscription")
  */
    public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) {
      //UserPasswordEncoder permet de crypter les mots de passe dans la BDD
        $utilisateurs = new Utilisateurs();
      
        $form = $this->createForm(InscriptionType::class, $utilisateurs);
        // Ici on relie les champs du formulaire aux champs de l'utilisateur

        $form->handleRequest($request);
        // Analyse la requête qui sera envoyée via le formulaire d'inscription
        if($form->isSubmitted() && $form->isValid()) {
        // si le formulaire est soumi et qu'il est valide
            $hash = $encoder->encodePassword($utilisateurs, $utilisateurs->getPassword());

            $utilisateurs->setPassword($hash);

            $manager->persist($utilisateurs);
            $manager->flush();

            return $this->redirectToRoute('general_accueil');
        } // Si le formulaire est soumis et que ses champs sont valide
          // Alors fait persister le formulaire et envoi les données.
      
        return $this->render('security/inscription.html.twig', [
          'form' => $form->createView()
      ]);
    }

  /**
  * @Route("/connexion", name="security_connexion")
  */
  public function connexion(AuthenticationUtils $authenticationUtils) {

    $error = $authenticationUtils->getLastAuthenticationError();
    // Erreur d'authentification

    $lastUsername = $authenticationUtils->getLastUsername();
    // Garde en mémoire le pseudo en cas d'erreur de saisie.

    return $this->render('security/connexion.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error ]
    );
  }

   /**
  * @Route("/deconnexion", name="security_deconnexion")
  */
  public function deconnexion() {

    return $this->render('security/deconnexion.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error ]
    );
  }
}

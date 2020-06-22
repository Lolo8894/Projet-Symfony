<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\InscriptionType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
  /**
  * @Route("/inscription", name="security_inscription")
  */
    public function inscription(Request $request, EntityManagerInterface $manager) {
      
        $utilisateurs = new Utilisateurs();
      
        $form = $this->createForm(InscriptionType::class, $utilisateurs);

        $form->handleRequest($request);
        // Analyse la requête qui sera envoyée via le formulaire d'inscription.
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($utilisateurs);
            $manager->flush();

            $this->addFlash('success', 'Inscription réussi');
            return $this->redirectToRoute('general_accueil');
        } // Si le formulaire est soumis et que ses champs sont valide
          // Alors fait persister le formulaire et envoi les données.
      
        return $this->render('security/inscription.html.twig', [
          'form' => $form->createView()
      ]);
    }
}

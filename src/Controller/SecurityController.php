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

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($utilisateurs);
            $manager->flush();
        }
      
        return $this->render('security/inscription.html.twig', [
          'form' => $form->createView()
      ]);
    }
}

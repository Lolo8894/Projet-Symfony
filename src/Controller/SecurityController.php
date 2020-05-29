<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Utilisateurs;
use App\Form\InscriptionType;

class SecurityController extends AbstractController
{
  /**
  * @Route("/inscription", name="security_inscription")
  */
    public function inscription() {
      
        $utilisateurs = new Utilisateurs();
      
        $form = $this->createForm(InscriptionType::class, $utilisateurs);
      
        return $this->render('security/inscription.html.twig', [
          'form' => $form->createView()
      ]);
    }
}

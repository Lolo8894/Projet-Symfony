<?php

namespace App\Security;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class AppAuthenticator extends AbstractGuardAuthenticator
{
    private $entityManager;
    private $urlGenerator;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->encoder = $encoder;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'security_connexion' && $request->isMethod('POST');
    } 
      // 1) Permet de savoir si l'on est sur la page d'authentification. Méthode supports doit retourner true quand on est sur la page de connexion et que le formulaire est envoyé.

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('_username'),
            'password' => $request->request->get('_password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $utilisateur = $this->entityManager->getRepository(Utilisateurs::class)->findOneBy(['email' => $credentials['email']]);

        if (!$utilisateur) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        return $utilisateur;
    }

    public function checkCredentials($credentials, UserInterface $utilisateur)
    {
        //dd($utilisateur->getPassword(), $credentials['password']);
        $hash = $this->encoder->encodePassword($utilisateur, $credentials['password']);
        return $utilisateur->getPassword() === $hash;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->urlGenerator->generate('general_accueil'));
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }
}

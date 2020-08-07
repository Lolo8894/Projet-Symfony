<?php

namespace App\Security;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private $doctrine;

    public function __construct(EntityManagerInterface $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function loadUserByUsername(string $username)
    {
        return $this->doctrine->getRepository(Utilisateurs::class)->findOneBy([
            'email' => $username
        ]);
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass(string $class)
    {
        return Utilisateurs::class === $class;
    }

}
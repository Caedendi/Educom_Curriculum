<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $em;
    private $um;
    private $encoder;

    public function __construct(
        EntityManagerInterface $em,
        UserManagerInterface $um,
        UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->um = $um;
        $this->encoder = $encoder;
    }

    public function createUser($params)
    {
        $u = $this->um->findUserByEmail($params["email"]);
        if (!$u) { // if user does not exist, create new user
            $user = $this->um->createUser();
            $user->setUsername($params["email"]);
            $user->setEmail($params["email"]);
            $user->setEnabled(true);
            $password = $this->encoder->encodePassword($user, $params["password"]);
            $user->setPassword($password);

            $this->um->updateUser($user);

            // IETS MET DE EM? of andere transactie

            return $user;
        } else {
            return ("bestaat al...");
        }
    }

    public function findUserByUsernameOrEmail($usernameOrEmail)
    {
        return $this->um->findUserByUsernameOrEmail($usernameOrEmail);
    }
}
<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\User;

class LoginService {

    private $container;
    private $em;
    private $um;
    private $encoder;
  
    public function __construct(ContainerInterface $container,
                                EntityManagerInterface $em,
                                UserManagerInterface $um, 
                                UserPasswordEncoderInterface $encoder) {

        $this->container = $container;
        $this->em = $em;
        $this->um = $um;
        $this->encoder = $encoder;
      
    }

    public function login($request) {


        $username = $request->headers->get('username');
        $passwd = $request->headers->get('password');

        $u = $this->um->findUserByEmail(\trim($username));
        if($u) {
          
            $valid = $this->encoder->isPasswordValid($u,$passwd);
            if($valid) {
                $token = new UsernamePasswordToken($u, null, 'main', $u->getRoles());
                $this->container->get('security.token_storage')->setToken($token);
                $this->container->get('session')->set('_security_main', serialize($token));
        
                $event = new InteractiveLoginEvent($request, $token);
                $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);

                return($u);
            }

        } else {
            return(false);
        }

    }

}
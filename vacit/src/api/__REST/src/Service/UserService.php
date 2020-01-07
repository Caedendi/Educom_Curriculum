<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserService {
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;        
    }

    public function findUserById($id) {
        $data = $this->em->getRepository(User::class)->find($id);
        return($data);
    }


    public function getAllUsers() {

        $data = $this->em->getRepository(User::class)->findAll();       
        return($data);
    }


    public function createUser($username) {
   
        // TODO: Onderbrengen in Repository!!!

        $u = new User();
        $u->setName($username);
        $this->em->persist($u);
        $this->em->flush();

        return($u);
       
    }

    public function updateUser($id, $username) {
   
        // TODO: Onderbrengen in Repository!!!
       

        $u = $this->em->getRepository(User::class)->find($id);

        if($u) {
            $u->setName($username);
            $this->em->persist($u);
            $this->em->flush();
            return($u);
        }

        return(false);
       
    }


    public function deleteUser($id) {
        $u = $this->em->getRepository(User::class)->find($id);

        if($u) {
            $this->em->remove($u);
            $this->em->flush();
            return(true);
        }

        return(false);
    }


}

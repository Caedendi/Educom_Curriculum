<?php

namespace App\Service;

use App\Entity\Poppodium;
use Doctrine\ORM\EntityManagerInterface;

class AddPoppodiumService
{
    private $em;
    private $repo;

    public function __construct(
        EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Poppodium::class);
    }

    public function addPoppodium($params)
    {
        $this->repo->savePodium($params);
    }

    public function addPoppodiums($poppodiums)
    {
        foreach($poppodiums as $row) {
            $this->repo->savePodium($row);
        }
    }
}
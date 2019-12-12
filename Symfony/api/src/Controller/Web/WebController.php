<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WebController extends AbstractController
{

    /**
     * @Route("/", name="home_page")
     */
    public function index()
    {
        $data = "hoi";
        return $this->render('web/homepage.html.twig', [
            'data' => $data,
        ]);
    }
}
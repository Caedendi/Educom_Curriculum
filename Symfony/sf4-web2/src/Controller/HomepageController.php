<?php

namespace App\Controller;

use App\Entity\Optreden;
use App\Entity\Poppodium;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/optredens", name="optredens")
     */
    public function optredens()
    {
        $rep = $this->getDoctrine()
            ->getRepository(Optreden::class);
        $data = $rep->getAllOptredens();

        dump($data);
        die();
    }
    /**
     * @Route("/optredens2", name="optredens2")
     * @Template()
     */
    public function optredens2()
    {
        $data = $this->getDoctrine()->getRepository(Poppodium::class)->findAll();
        return(array(
            'controller_name' => 'HomepageController',
            "poppodia" => $data
        ));
    }
}

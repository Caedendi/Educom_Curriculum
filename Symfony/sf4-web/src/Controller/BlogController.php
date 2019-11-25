<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends BaseController
{
    /**
     * @Route("/{page}", name="blog_list", requirements={"page"="\d+"})
     * @Template()
     */
    public function index($page)
    {
        $data = [
            'controller_name' => "Index voor page: $page",
        ];

        return $data;
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     */
    public function show($id = 1) //, LoggerInterface $logger)
    {
        // $logger->info("info Message");
        // $logger->warning("Warning Message");
        // $logger->error("De waarde van id is: $id");
        dump($id);
        die();
    }
}

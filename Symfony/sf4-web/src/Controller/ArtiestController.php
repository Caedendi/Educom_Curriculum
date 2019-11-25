<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Artiest;

class ArtiestController extends BaseController
{
    /**
     * @Route("/artiest", name="artiest")
     * Template()
     */
     public function index()
     {
         $params = array(
             "naam" => "At The Gates",
             "genre" => "Melodic Death Metal",
             "omschrijving" => "",
             "afbeelding_url" => "",
             "website" => "http://atthegates.se/"
         );

         $rep = $this->getDoctrine()->getRepository(Artiest::class);
         $artiest = $rep->saveArtiest($params);

         dump($artiest);
         die();
     }
}

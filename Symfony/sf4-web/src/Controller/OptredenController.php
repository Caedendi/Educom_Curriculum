<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Optreden;

class OptredenController extends BaseController
{
    /**
     * @Route("/optreden", name="optreden")
     * Template()
     */
    public function index()
    {
        $params = array(
            "id" => 2,
            "poppodium_id" => 1,
            "artiest_id" => 2,
            "omschrijving" => "Optreden van Metallica met in het voorprogramma AC/DC en Aerosmith.",
            "datum" => new \DateTime("2020-06-01 19:00:00"),
            "prijs" => 70.00,
            "ticket_url" => "",
            "afbeelding_url" => "",
            "voorprogramma" => array(1, 4)
        );

        $rep = $this->getDoctrine()->getRepository(Optreden::class);
        $optreden = $rep->saveOptreden($params);

        dump($optreden);
        die();
    }
}

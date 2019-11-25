<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Poppodium;

class PoppodiumController extends BaseController
{
    private $rep;
    /**
     * @Route("/poppodium", name="poppodium")
     * @Template()
     */
    public function index()
    {
        $this->getRep();
        $result = 0;
        // $result = $this->createPodiumNieuweNor();
        // $result = $this->removePodium("Nieuwe Nor");
        dump($result);
        die();
    }

    public function getRep() {
        $this->rep = $this->getDoctrine()->getRepository(Poppodium::class);
    }

    public function createPodiumNieuweNor() {
        $params = array(
            "naam" => "Nieuwe Nor",
            "adres" => "Pancratiusstraat 30",
            "postcode" => "6411KC",
            "woonplaats" => "Heerlen",
            "telefoonnummer" => "0454009100",
            "website" => "https://nieuwenor.nl/",
            "logo_url" => "https://www.nieuwenor.nl/img/logo-white-sm.png/",
            "afbeelding_url" => ""
        );

        $podium = $this->rep->savePodium($params);

        return($podium);
    }

    public function removePodium($naam) {
        $id = $this->rep->findPodiumByNaam("$naam")->getId();
        $result = $this->rep->removePodium($id);

        return($result);
    }
}

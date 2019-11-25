<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Dotenv\Dotenv;

use App\Entity\Optreden;

/**
 * @Route("/")
 */
class HomepageController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function index()
    {
        $rep = $this->getDoctrine()
            ->getRepository(Optreden::class);
        $data = $rep->getAllOptredens();

        dump($data);
        // die();

        $data2 = array(
            'controller_name' => $this->upload_dir
        );

        return $data2;
    }

    /**
     * @Route("/backhome", name="backhome")
     */
    public function backhome()
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route({
     *     "en": "/contact-us",
     *     "nl": "/neem-contact-op"
     * }, name="contact")
     */
    public function contact(Request $request)
    {
        $locale = $request->getLocale();
        $msg = 'This page is in English';
        if ('nl' == $locale) {
            $msg = 'Deze pagina is in het Nederlands';
        }

        return new Response(
            "<html><body>$msg</body></html>"
        );
    }

    /**
     * @Route("/data.{_format}",
     *        name="api_output",
     *        requirements={"_format": "xml|json"})
     */
    public function api($_format)
    {
        $data = [
            ['id' => 1, 'naam' => 'Piet'],
            ['id' => 2, 'naam' => 'Wilma'],
            ['id' => 3, 'naam' => 'Harrie'],
        ];

        if ('json' == $_format) {
            return $this->json($data);
        } else {
            /// Om een array naar XML om te zetten is een parser nodig.
            /// Hier even een very quick en very dirty oplossing
            /// - die je eventueel ook met Twig zou kunnen maken.
            $d = '<data>';
            foreach ($data as $record) {
                $id = $record['id'];
                $naam = $record['naam'];
                $d .= "<record id='$id'>$naam</record>";
            }
            $d .= '</data>';

            return new Response($d);
        }
    }
}

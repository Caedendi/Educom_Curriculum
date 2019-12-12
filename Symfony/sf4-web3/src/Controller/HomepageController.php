<?php

namespace App\Controller;

use App\Entity\Optreden;
use App\Entity\Poppodium;
use App\Entity\User;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\UserService;

/**
 * @Route("/")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param UserService $userService
     * @return array
     */
    public function optredens2(UserService $userService)
    {
//        $params = array(
//            "username" => "Henk",
//            "password" => "LolligeVent",
//            "email" => "henk@lolligevent.nl"
//        );
//
//        $user = $userService->createUser($params);
//        dump($user);

//        $this->addFlash("notice", "De wijzigingen zijn opgeslagen.");

        $user = $userService->findUserByUsernameOrEmail("BigB0ss1");

        $data = $this->getDoctrine()->getRepository(Poppodium::class)->findAll();
//        $datums = $this->getDoctrine()->getRepository(Optreden::class)->findByDateDQL();

        return (array(
            'controller_name' => 'HomepageController',
            "poppodia" => $data,
//            "datums" => $datums,
            "user" => $user,
        ));
    }

    /**
     * @Route("/upc", name="userProfileCard")
     * @Template
     * @param UserService $userService
     * @return array
     */
    public function userProfileCard(UserService $userService)
    {
        $user = $userService->findUserByUsernameOrEmail("BigB0ss");
        return array(
            'controller_name' => 'HomepageController',
            'user' => $user,
        );
    }
}

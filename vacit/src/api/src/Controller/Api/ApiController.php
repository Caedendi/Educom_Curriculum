<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// FOS User Bundle
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// END

class ApiController extends AbstractFOSRestController
{
    private $rep = "repo"; // TODO: make repository

    /**
     * @Rest\Get("/people")
     * @param Request $request
     * @return View
     */
    public function getList(Request $request): View
    {
        $data = [
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
            [
                "id" => 1234,
                "name" => "Jan",
                "username" => "Janssen",
                "email" => "example@hoi.nl",
            ], [
                "id" => 1235,
                "name" => "Klaas",
                "username" => "Klaassen",
                "email" => "example@hoi.nl",
            ],
        ];
        array_push($data, ["id" => 1236, "name" => "Lilo", "username" => "Lola", "email" => "example@hoi.nl"]);
        return (View::create($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/item/{id}")
     * @param Request $request
     * @return View
     */
    public function getItemById(Request $request): View
    {
        $id = $request->get("id");
        $data = ["id" => $id,
            "voornaam" => "Jan",
            "achternaam" => "Janssen",
        ];
        return (View::create($data, Response::HTTP_OK));
    }

    //
    // reader pagina 151
    //

    /**
     * @Rest\Post("/item/create")
     * @param Request $request
     * @return View
     */
    public function itemCreate(Request $request): View
    {
        $params["voornaam"] = $request->get("voornaam");
        $params["achternaam"] = $request->get("achternaam");
        $data = $this->rep->saveData($params);
        return (View::create($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Put("/item/update/{id}")
     * @param Request $request
     * @return View
     */
    public function updateMens(Request $request): View
    {
        $params["id"] = $request->get("id");
        $params["voornaam"] = $request->get("voornaam");
        $params["achternaam"] = $request->get("achternaam");
        $data = $this->rep->saveData($params);
        return (View::create($data, Response::HTTP_OK));
    }

    /**
     * @Rest\Delete("/item/delete/{id}")
     * @param Request $request
     * @return View
     */
    public function deleteMens(Request $request): View
    {
        $params["id"] = $request->get("id");
        $data = $this->rep->deleteData($params);
        return (View::create($data, Response::HTTP_OK));
    }

    //
    //
    // d.m.v. FOS User Bundle
    //
    //

    /*

    protected $container;
    private $um;
    private $encoder;

    public function __construct(
        ContainerInterface $container,
        UserManagerInterface $um,
        UserPasswordEncoderInterface $encoder)
    {
        $this->container = $container;
        $this->um = $um;
        $this->encoder = $encoder;
    }

    private function login($request)
    {
        $username = $request->get("username");
        $password = $request->get("password");
        $u = $this->um->findUserByEmail(\trim($username));
        if ($u) {
            $password = $this->encoder->encodePassword($u, $password);
            if ($u->getPassword() === $password) {
                $token = new UsernamePasswordToken($u, null, "main", $u->getRoles());
                $this->container->get("security . token_storage")->setToken($token);
                $this->container->get("session")->set("_security_main", serialize($token));
                $event = new InteractiveLoginEvent($request, $token);
                $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);
                return ($u);
            }
        }
        return (false);
    }

    */
}
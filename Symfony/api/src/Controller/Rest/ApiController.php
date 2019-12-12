<?php

namespace App\Controller\Rest;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiController extends AbstractFOSRestController
{
    private $appSecret;
    private $container;
    private $um;
    private $encoder;

    public function __construct(ContainerInterface $container,
                                UserManagerInterface $um,
                                UserPasswordEncoderInterface $encoder)
    {
        $this->container = $container;
        $this->um = $um;
        $this->encoder = $encoder;
        $this->appSecret = getenv("APP_SECRET");
    }

    private function checkToken(Request $request)
    {
        $token = $request->headers->get("-client-token");
        if (!isset($token) || $token !== $this->appSecret) {
            return (false);
        }
        return (true);
    }

    private function login(Request $request)
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
                $this->container->get("event_dispatcher")->dispatch(
                    "security.interactive_login", $event);
                return ($u);
            }
        }
        return (false);
    }

    /**
     * @Rest\Get("/")
     */
    public function getList(Request $request): View
    {
        $valid = $this->checkToken($request);
        if ($valid) {
            $data = [
                [
                    "id" => 1234,
                    "voornaam" => "Jan",
                    "achternaam" => "Janssen",
                ], [
                    "id" => 1235,
                    "voornaam" => "Klaas",
                    "achternaam" => "Klaassen",
                ]
            ];
            return (View::create($data, Response::HTTP_OK));
        }
        return (View::create(["status" => Response::HTTP_FORBIDDEN],
            Response::HTTP_FORBIDDEN));
    }

    /**
     * @Rest\Get("/item/{id}")
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

    /**
     * @Rest\Post("/item/create")
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
     */
    public function deleteMens(Request $request): View
    {
        $params["id"] = $request->get("id");
        $data = $this->rep->deleteData($params);
        return (View::create($data, Response::HTTP_OK));
    }
}
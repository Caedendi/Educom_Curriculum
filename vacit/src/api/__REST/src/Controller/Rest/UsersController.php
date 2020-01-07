<?php

namespace App\Controller\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use App\Service\UserService;
use App\Service\LoginService;

class UsersController extends FOSRestController
{

    private $request;
    private $userService;
    private $loginService;

    private $appSecret;

    public function __construct(UserService $us, LoginService $ls) {

        $this->appSecret = getenv('APP_SECRET');
        $this->userService = $us;
        $this->loginService = $ls;

    }


    private function checkToken(Request $request) {
       
      
       $token = $request->headers->get('-client-token');
       if(!isset($token) || $token !== $this->appSecret) {
         return false;
       }

       return true;
    }

    /**
     * @Rest\Get("/users")
     */
    public function getUsers(Request $request):View
    {
        $valid = $this->checkToken($request);
        if($valid) {
            if($this->loginService->login($request)) {
                $data = $this->userService->getAllUsers();           
                return( View::create($data, Response::HTTP_OK) );       
            }
        }
        return( View::create(["status" => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN) );     
    }

     /**
     * @Rest\Get("/user/{id}")
     */
    //public function getUserById(int $id):View
    public function getUserById(Request $request):View
    {
       $id = $request->get('id');
       $data = $this->userService->findUserById($id);
       return( View::create($data, Response::HTTP_OK) );     
    }

   /**
     * @Rest\Post("/user/create")
     */
    public function postUser(Request $request)
    {
        $username = $request->get('username');
        $data = $this->userService->createUser($username);
        return $this->view($data, Response::HTTP_CREATED);       
    }

    /**
     * @Rest\Put("/user/update")
     */
    public function putUser(Request $request)
    {
        $username = $request->get('username');
        $id = $request->get('id') ? $request->get('id') : false;

        $data = $this->userService->updateUser($id, $username);
        if($id && $data) {
            return $this->view($data, Response::HTTP_CREATED);       
        }
   
        return $this->view(["status" =>  Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
       

    }

     /**
     * @Rest\Delete("/user/delete/{id}")
     */
    public function deleteUser(Request $request)
    {
        $id = $request->get('id');
        $data = $this->userService->deleteUser($id);
        if($data) {
            return( View::create(["delete" => $data], Response::HTTP_OK) );             
        }
        return $this->view(["status" =>  Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
    }

    
    
    
}

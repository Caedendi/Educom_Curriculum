<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Dotenv\Dotenv;

class BaseController extends AbstractController
{
    protected $upload_dir;

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load('../.env');
        $this->upload_dir = getenv('UPLOAD_DIR');
    }
}

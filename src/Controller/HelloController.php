<?php

// src/Controller/HelloWorldController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{param}', name: 'hello_world')]
    public function index(string $param): Response
    {
        return $this->render('hello.html.twig', [
            'param' => $param,
        ]);
    }
}

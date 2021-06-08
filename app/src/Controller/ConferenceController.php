<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="homepage", methods={"GET"})
     */
    public function index($name = ''): Response
    {
        return new Response("Hello, $name");

        return $this->render('conference/index.html.twig');
    }
}

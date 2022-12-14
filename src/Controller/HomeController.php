<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{

    // on utilise l'autowiring pour ajouter twig au controller
    /**
     * @var Twig\Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;    }

    #[Route('/')]
    public function index() : Response
    {
        return $this->render('home/index.html.twig');
    }

}
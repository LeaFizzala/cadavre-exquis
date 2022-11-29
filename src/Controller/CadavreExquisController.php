<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CadavreExquisController extends AbstractController
{

    #[Route('/lastCorpse')]
    public function index(){
        //méthode pour afficher le dernier cadavre exquis
        return new Response($this->render('cadavreExquis/index.html.twig'));

    }
}
<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\CadavreExquis;
use App\Repository\CadavreExquisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;




class CadavreExquisController extends AbstractController
{
    /**
     * @var Twig\Environment
     */
    private $twig;
    /**
     * @var CadavreExquisRepository
     */
    private $cadavreExquisRepository;


    public function __construct(Environment $twig, CadavreExquisRepository $cadavreExquisRepository)
    {
        $this->twig = $twig;
        $this->cadavreExquisRepository = $cadavreExquisRepository;
    }

    #[Route('/allCorpses')]
    public function index(){
        //méthode pour afficher tous les cadavres exquis
        return new Response($this->render('cadavreExquis/index.html.twig'));

    }
    #[Route('/newCorpse')]
    public function new(EntityManagerInterface $em){
        $cadavreExquis = new CadavreExquis();
        $cadavreExquis->setTexte('Ceci est mon cadavre exquis pas très long.');
        $em->persist($cadavreExquis);
        $em->flush();
        die('Un cadavre, un ! ');
    }
}
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
use App\Form\CadavreExquisType;




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
        $cadavres = $this->cadavreExquisRepository->findAll();
        $lastCorpse = $this->cadavreExquisRepository->findBy(array(), array('id' => 'DESC'), 1);

        return new Response($this->render('cadavreExquis/index.html.twig',
        ['cadavres' => $cadavres,
        'lastCorpse' => $lastCorpse]));

    }
    #[Route('/newCorpse')]
    public function new(EntityManagerInterface $em, Request $request){
        //on instancie un nouvel objet vide
        $cadavreExquis = new CadavreExquis();

        //puis un nouvel objet de type form
        $form = $this->createForm(CadavreExquisType::class, $cadavreExquis);
        //le formulaire s'occupe de gérer les données envoyées
        $form->handleRequest($request);
        // si le formulaire est validé, la page retourne à l'index
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($cadavreExquis);
            $em->flush();
            return $this->redirectToRoute('app_cadavreexquis_index');
        }

        return $this->render('cadavreExquis/new.html.twig',
        ['cadavreExquis' => $cadavreExquis,
            'form' => $form->createView()
            ]
        );
    }

    public function lastCorpse(){
    $lastCorpse = $this->cadavreExquisRepository->findByCreatedAt();
        return $lastCorpse;

    }
}
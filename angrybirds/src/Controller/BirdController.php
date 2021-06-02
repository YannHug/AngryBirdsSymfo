<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route(name="bird_")
 */
class BirdController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index(BirdModel $birdModel): Response
    {
        //* On met le model dans les parametres de la methode et cela permet d'eviter d'instancier avec un new
        //* De plus la variable peut etre utilser directement dans le tableau de retour
        //$birdModel = new BirdModel;
        //$birds = $birdModel->getBirds();

        return $this->render('bird/index.html.twig', [
            'birds' => $birdModel->getBirds()
            //* le tableau avec birds => $birdModel correspond à notre varData en php
        ]);
    }

    /**
     * @Route("/bird/{index}", name="show", requirements={"index"="\d+"})
     */
    public function show(BirdModel $birdModel, int $index, SessionInterface $session)
    {
        //On peut ajouter des données dans la session
        $session->set('lastBirdSeen', $index);
        $bird = $birdModel->getBird($index);

        // Si $bird est null -> on leve une erreur (exception)
        if ($bird === null) {
            // Symfony crée un objet de class NotFoundHttpException
            // On lance avec throw (pas besoin de try et catch -> integré à Symony)
            throw $this->createNotFoundException("L'oiseau demandé n'existe pas !");
        }

        return $this->render('bird/show.html.twig', [
            'bird' => $bird,
            'index' => $index
        ]);
    }

    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar()
    {
        // ->file() crée un objet Response avec notre fichier dedans
        //? @see https://symfony.com/doc/current/controller.html#streaming-file-responses
        //* ResponseHeaderBag -> permet d'afficher dans le navigateur (DISPOSITION_INLINE), si pas defini ça télecharge directement.
        return $this->file('angry_birds_2015_calendar.pdf', null,  ResponseHeaderBag::DISPOSITION_INLINE);
    }
}

<?php

namespace App\Controller\Api;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/birds", name="api_bird_")
 */
class BirdController extends AbstractController
{
    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function index(BirdModel $birdModel): Response
    {
        return $this->json($birdModel->getBirds());
    }

    /**
     * @Route("/{index}", name="show", methods={"GET"}, requirements={"index"="\d+"})
     */
    public function show(BirdModel $birdModel, int $index)
    {
        $bird = $birdModel->getBird($index);

        if ($bird === null) {
            return $this->json($bird, 404);
        }

        return $this->json($bird);
    }
}

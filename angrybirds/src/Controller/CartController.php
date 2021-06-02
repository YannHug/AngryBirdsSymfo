<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/cart/", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function index(BirdModel $birdModel, SessionInterface $session): Response
    {
        // On recupère notre panier
        // $cart est forcement un array soit vide, soit avec des données en session
        $cart = $session->get('cart', []);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'birds' => $birdModel->getBirds()
        ]);
    }

    /**
     * @Route("add", name="add", methods={"POST"})
     */
    public function add(SessionInterface $session, Request $request)
    {
        // On récupère l'index reçu en POST dans $request
        // $request->request contient les valeurs reçues dans $_POST
        // $request->query contient les valeurs reçues dans $_GET
        $index = $request->request->get('index');

        // On recupère le contenu du panier dans la session
        $cart = $session->get('cart', []);

        // On ajoute notre oiseau au panier
        // On test si l'oiseau est deja dans le panier
        if (isset($cart[$index])) {
            // si oui on incremente
            $cart[$index]++;
        } else {
            // sinon on crée une entrée
            $cart[$index] = 1;
        }

        // On redefini le contenu du panier
        $session->set('cart', $cart);

        // Ajout dans le panier, confirmatiuon par message flash
        $this->addFlash('success', 'Ajout de l\'oiseau dans le panier, il y en a maintenant ' . $cart[$index]);

        // On redirige l'utilisateur sur la page du panier
        // redirectToRoute crée un objet Response avec code 302
        return $this->redirectToRoute('cart_list');
    }

    /**
     * @Route("remove", name="remove", methods={"DELETE"})
     */
    public function remove(SessionInterface $session, Request $request)
    {
        $index = $request->request->get('index');

        $cart = $session->get('cart', []);

        if (isset($cart[$index])) {
            $cart[$index]--;
        }
        $this->addFlash('warning', 'Suppression de l\'oiseau du panier, il y en a maintenant ' . $cart[$index]);

        // On verifie si quantité inferieur à 1
        // si c'est le cas on enleve l'oiseau du panier
        if ($cart[$index] < 1) {
            unset($cart[$index]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_list');
    }
}

//TODO faire un bouton supprimer l'oiseau directement
//TODO faire un bouton supprimer le panier
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrizeController extends AbstractController
{
    /**
     * @Route("/prize", name="prize")
     */
    public function index(Request $request)
    {

        dump($this->isCsrfTokenValid('game-token', $request->get('token')));

        if (
            $request->get('game') && $request->get('game') === 'secret'
        ) {
            dump(true);
        } else dump(false);

        return $this->render('prize/index.html.twig', [
            'controller_name' => 'PrizeController',
        ]);
    }
}

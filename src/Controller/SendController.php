<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SendController extends AbstractController
{
    /**
     * @Route("/send", name="send")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
        // TODO Check autharization and redirect if Error

        dump($request->get('thingId'));
        dump($user);

        return $this->render('prize/win.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
}

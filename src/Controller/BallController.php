<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BallController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/ball", name="ball")
     */
    public function index(Request $request)
    {

        // TODO set Reload Protection. Design logic of it!

        /** @var User $user */
        $user = $this->getUser();
        // TODO Check autharization and redirect if Error

        $balls = (int) $request->get('ballsAmount');

        $user->setBalls($user->getBalls() + $balls);

        $this->entityManager->flush();
        // dd($user->getBalls());

        return $this->render('win/balls.html.twig', [
            'winBalls' => $balls,
            'user' => $user
        ]);
    }
}

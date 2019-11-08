<?php

namespace App\Controller;

use App\Entity\Money;
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
    public function ball(Request $request)
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

    /**
     * @Route("/money-to-ball", name="money-to-ball")
     */
    public function moneyToBall(Request $request)
    {

        /** @var User $user */
        $user = $this->getUser();
        // TODO Check autharization and redirect if Error
        $course = $user->getCourse();

        $moneyId = $request->get('moneyId');

        /** @var Money $thing */
        $money = $this->entityManager->getRepository(Money::class)
            ->findOneBy(
                [
                    'id' => $moneyId,
                    'isEnabled' => true
                ]
            );

        // TODO if $thing not found - probably it is already won! Need to set a logic here
        if (!$money) {
            throw $this->createNotFoundException(
                "Этот приз id: {$moneyId} больше не доступен!"
            );
        }

        $moneyAmount = $money->getAmount();
        $balls = intval(floor($moneyAmount / $course));

        $user->setBalls($balls);

        $this->entityManager->flush();

        return $this->render('win/balls.html.twig', [
            'winBalls' => $balls,
            'user' => $user
        ]);
    }
}

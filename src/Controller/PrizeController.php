<?php

namespace App\Controller;

use App\Services\Games\GiftsGame;
use App\Services\SPL as Prize;
use App\Services\SPL\IPrize;
use App\Services\Utils\RandomInt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrizeController extends AbstractController
{
    private $gifts = [
        Prize\SMoney::class,
        Prize\SThing::class,
        Prize\SBall::class
    ];

    /** @var EntityManagerInterface $manager */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/prize", name="prize")
     */
    public function index(
        // Request $request,
        GiftsGame $game,
        RandomInt $randomizer
    ) {

        // dump($this->isCsrfTokenValid('game-token', $request->get('token')));

        // if (
        //     $request->get('game') && $request->get('game') === 'secret'
        // ) {
        //     dump(true);
        // } else dump(false);

        $gift = null;

        /** @var GiftsGame $newGame */
        $newGame = new $game(
            $randomizer,
            $this->gifts, // TODO to remote
            $this->manager
        );

        $gift = $newGame->init();
        $prizeCategory = $newGame->getPrizeCategory();
        // dump($gift);

        $this->getRender($prizeCategory::NAME, $gift);

        return $this->render('prize/index.html.twig', [
            'controller_name' => 'PrizeController',
            'gift' => '$gift',
        ]);
    }

    // TODO Interface Prize $gift
    private function getRender(string $name, $gift)
    {
        switch ($name) {
            case "Money":
                dump("Money");
                dump($gift->getAmount());
                break;
            case "Thing":
                dump('Thing');
                dump($gift->getName());
                break;
            case "Ball":
                dump("Ball");
                dump($gift);
                break;
        }
    }
}

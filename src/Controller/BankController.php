<?php

namespace App\Controller;

use App\Entity\Money;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BankController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/bank", name="bank")
     */
    public function bank(Request $request)
    {

        /** @var User $user */
        $user = $this->getUser();
        // TODO Check autharization and redirect if Error
        dump($user);

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
                'Этот приз больше не доступен!' . $moneyId
            );
        }

        $money->setIsEnabled(false);

        $this->entityManager->flush();
        // dump($thing);

        return $this->render('win/money.html.twig', [
            'money' => $money,
            'user' => $user
        ]);
    }
}

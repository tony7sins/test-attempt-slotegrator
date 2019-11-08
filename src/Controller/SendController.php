<?php

namespace App\Controller;

use App\Entity\Thing;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SendController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/send", name="send")
     */
    public function index(Request $request)
    {

        /** @var User $user */
        $user = $this->getUser();
        // TODO Check autharization and redirect if Error
        // dump($user);

        $thingId = $request->get('thingId');

        // dump($thingId);

        /** @var Thing $thing */
        $thing = $this->entityManager->getRepository(Thing::class)
            ->findOneBy(
                [
                    'id' => $thingId,
                    'isEnabled' => true
                ]
            );

        // TODO if $thing not found - probably it is already won! Need to set a logic here
        if (!$thing) {
            throw $this->createNotFoundException(
                'Этот приз больше не доступен!' . $thingId
            );
        }

        $thing->setIsEnabled(false);

        $this->entityManager->flush();
        // dump($thing);

        return $this->render('win/thing.html.twig', [
            'thing' => $thing,
            'user' => $user
        ]);
    }
}

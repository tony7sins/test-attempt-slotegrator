<?php

namespace App\Services\SPL;

use App\Entity\Money;
use Doctrine\ORM\EntityManagerInterface;

class SMoney implements IPrize
{
    use TPrize;

    const NAME = "Money";
    const ENTITY = Money::class;

    /** @var EntityManagerInterface $em */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPrizes(): ?array
    {

        $money = $this->em
            ->getRepository(self::ENTITY)
            ->findBy(
                [
                    'isEnabled' => true
                ]
            );

        return $money;
    }
}

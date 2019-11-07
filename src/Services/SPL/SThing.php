<?php

namespace App\Services\SPL;

use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;

class SThing implements IPrize
{
    use TPrize;

    const NAME = "Thing";

    const ENTITY = Thing::class;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPrizes(): ?array
    {
        $thing = $this->em
            ->getRepository(self::ENTITY)
            ->findBy(
                [
                    'isEnabled' => true
                ]
            );
        // dump($thing);
        return $thing;
    }
}

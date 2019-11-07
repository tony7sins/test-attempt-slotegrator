<?php

namespace App\Services\SPL;

use Doctrine\ORM\EntityManagerInterface;

class SMoney implements IPrize
{
    use TPrize;

    const NAME = "Money";

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPrizes(): ?array
    {
        // dump($this->em);
        return ['money', 'glory'];
    }
}
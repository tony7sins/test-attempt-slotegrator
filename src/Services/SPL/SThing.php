<?php

namespace App\Services\SPL;

use Doctrine\ORM\EntityManagerInterface;

class SThing implements IPrize
{
    use TPrize;

    const NAME = "Thing";

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPrizes(): ?array
    {
        // dump($this->em);
        return [3, 5, 8];
    }
}

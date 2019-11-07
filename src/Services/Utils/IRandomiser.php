<?php

namespace App\Services\Utils;

use App\Entity\Interfaces\IPrize;

interface IRandomiser
{
    public function getRate(): intager;

    public function getPrice(): IPrize;
}

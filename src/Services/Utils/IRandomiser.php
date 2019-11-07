<?php

namespace App\Services\Utils;

interface IRandomiser
{

    public function init();

    public function getRandom();

    public function isValid();
}

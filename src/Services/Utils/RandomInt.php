<?php

namespace App\Services\Utils;

class RandomInt
{
    private $int;
    private $random;

    public function init(int $int = 0): self
    {
        $this->int = $int;
        $this->random = random_int(0, $int - 1);
        return $this;
    }

    public function getRandom()
    {
        return $this->random;
    }

    public function isValid()
    {
        if ($this->int === 0) return false;
        return true;
    }
}

<?php

namespace App\Services\Games;

use App\Services\SPL\IPrize;
use App\Services\Utils\RandomInt;
use Doctrine\ORM\EntityManagerInterface;

class GiftsGame
{

    /** @var array */
    private $gifts;

    /** @var RandomInt $randomizer */
    private $randomizer;

    /** @var int $random */
    private $random;

    /** @var IPrize $category  */
    private $category;

    public function __construct(
        RandomInt $randomizer,
        ?array $gifts = [],
        EntityManagerInterface $manager
    ) {
        $this->setGifts($gifts);
        $this->randomizer = $randomizer;
        $this->manager = $manager;
    }

    public function isValid()
    {
        if (count($this->gifts) <= 0) {
            return false;
        }
        return true;
    }

    private function setGifts($gifts): void
    {
        $this->gifts = $gifts;
    }

    public function init()
    {

        $category = $this->getGiftCategoty();

        // TODO Set logger here
        if ($category === null) {
            dump('УПС! что-то пошло не так!');
        }

        /** @var IPrize $item */
        $items = new $category($this->manager);

        // TODO Refactor to setCategory
        // TODO change var Names
        $this->category = $items;

        $prizes = $items->getPrizes();

        $gifts = [];

        if (count($prizes) <= 0) {

            $gifts = array_values(array_filter($this->gifts, function ($key) {
                return $key !== $this->random;
            }, ARRAY_FILTER_USE_KEY));

            $this->setGifts($gifts);

            return $this->init();
        }

        $item = $prizes[$this->getRandomInt(count($prizes))];

        return $item;
    }

    public function getPrizeCategory()
    {
        return $this->category;
    }

    private function getGiftCategoty()
    {

        $random = $this->getRandomInt(count($this->gifts));

        $category = null;

        if (null !== $random) {
            // dump($random);
            $category = $this->gifts[$random];
        }

        return $category;
    }

    private function getRandomInt(int $int = 0): ?int
    {

        $random = (new $this->randomizer)->init($int);
        $result = null;

        if ($random->isValid()) {
            $result = $random->getRandom();
        }

        $this->random = $result;

        return $result;
    }
}

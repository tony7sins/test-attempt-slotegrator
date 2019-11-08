<?php

namespace App\DataFixtures;

use App\Entity\Money;
use App\Entity\User;
use App\Entity\Thing;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /** @var array THINGS */
    private const THINGS = [
        [
            'name' => 'авто',
        ],
        [
            'name' => 'подгузник',
        ],
        [
            'name' => 'батарейка',
        ],
    ];

    /** @var UserPasswordEncoderInterface $encoder */
    private $encoder;

    public function __construct(
        UserPasswordEncoderInterface $encoder
    ) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
        $this->loadThings($manager);
        $this->loadMoney($manager);

        $manager->flush();
    }

    private function loadUser(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('username')
            ->setPassword($this->encoder->encodePassword(
                $user,
                'password'
            ))
            ->setAddress('Парагвай, улица Хосэ Луиза 3-его д-13')
            ->setBalls(0)
            ->setCourse(1.5);

        $manager->persist($user);

        // $manager->flush();
    }

    private function loadThings(ObjectManager $manager)
    {
        foreach (self::THINGS as $fixture) {
            // var_dump($thing['name']);
            $thing = new Thing();
            $thing
                ->setName($fixture['name'])
                ->setIsEnabled(true);

            $manager->persist($thing);
        }

        // $manager->flush();
    }

    private function loadMoney(ObjectManager $manager)
    {
        for ($i = 0; $i <= 4; $i++) {
            $money = new Money();

            $money
                ->setAmount(random_int(1, 1000))
                ->setIsEnabled(true);

            $manager->persist($money);
        }

        // $manager->flush();
    }
}

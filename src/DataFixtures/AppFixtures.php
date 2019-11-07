<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface $encoder */
    private $encoder;

    public function __construct(
        UserPasswordEncoderInterface $encoder
    ) {
        $this->encoder          = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user
            ->setUsername('username')
            ->setPassword($this->encoder->encodePassword(
                $user,
                'password'
            ));

        $manager->persist($user);

        $manager->flush();
    }
}

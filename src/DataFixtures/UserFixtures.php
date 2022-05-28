<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['email' => 'test1@example.com']);
        if ($user === null) {
            $new_user = new User();
            $new_user->setEmail('test1@example.com');
            $hashedPassword = $this->hasher->hashPassword($new_user, 'password');
            $new_user->setPassword($hashedPassword);
            $manager->persist($new_user);
            $manager->flush();
        }
    }
}

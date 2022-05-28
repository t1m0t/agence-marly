<?php

namespace App\DataFixtures;

use App\Entity\Bien;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\BienRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BiensFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 30; $count++) {
            $bien = new Bien();
            $bien->setAdresse($this->randomAdresse());
            $type = $this->getType();
            $bien->setType($type);
            $bien->setPrix($this->getPrix($type));
            $bien->setSurface(rand(18, 200));
            $bien->setCarrez('T' . rand(1, 5));
            $bien->setEstVendu(false);
            $bien->setTitre($this->randomWords(15, 30, 1));
            $bien->setDescription($this->randomWords(3, 10, 20));
            $responsable = $manager->getRepository(User::class)->findAll()[0];
            $bien->setResponsable($responsable);
            $manager->persist($bien);
        }

        $manager->flush();
    }

    private function randomWords(int $minSize, int $maxSize, int $times): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $times; $i++) {
            $randomWord = '';
            $max = rand($minSize, $maxSize);
            for ($y = 0; $y < $max; $y++) {
                $index = rand(0, strlen($characters) - 1);
                $randomWord .= $characters[$index];
            }
            $randomString = $randomString . ' ' . $randomWord;
        }

        return $randomString;
    }

    private function randomAdresse(): string
    {
        $number = rand(1, 250);
        $types = ['rue', 'avenue', 'impasse'];
        $adresse = $number . ' ' . $types[rand(0, count($types) - 1)] . ' ' . $this->randomWords(5, 20, 1) . ' ' . rand(95000, 95999) . ' ' .  $this->randomWords(5, 20, 1);
        return $adresse;
    }

    private function getType(): string
    {
        $types = BienRepository::TYPES;
        $max = rand(0, count($types) - 1);
        return $types[rand(0, $max)];
    }

    private function getPrix($type): int
    {
        $prix = 0;
        $type === 'location' ? $prix =  rand(400, 1500) :  $prix =  rand(150_000, 2_000_000);
        return $prix;
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}

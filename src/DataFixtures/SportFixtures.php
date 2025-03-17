<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sportsData = [
            'Shooting',
            'Cycling',
            'Running',
        ];

        foreach ($sportsData as $sportName) {
            $sport = new Sport();
            $sport->setName($sportName);
            $manager->persist($sport);
            // We use reference to be able to use it in next fixtures
            $this->addReference('sport_' . strtolower($sportName), $sport);
        }

        $manager->flush();

        $manager->flush();
    }
}

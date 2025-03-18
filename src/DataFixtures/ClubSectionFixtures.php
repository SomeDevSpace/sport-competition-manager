<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\ClubSection;
use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClubSectionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Array of club references (from ClubFixtures)
        $clubReferences = [
            'club_legia' => [
                'sport_running',
                'sport_cycling',
                'sport_shooting',
            ],
            'club_lech' => [
                'sport_running',
            ],
            'club_wisla' => ['sport_cycling', 'sport_shooting'],
            'club_slask' => ['sport_running', 'sport_cycling'],
            'club_gornik' => ['sport_running'],
            'club_ks_swit' => ['sport_shooting']
        ];

        // Create ClubSection entries for each club and each sport
        foreach ($clubReferences as $clubRef => $sportReferences) {
            foreach ($sportReferences as $sportRef) {
                $clubSection = new ClubSection();
                $clubSection->setClub($this->getReference($clubRef, Club::class));
                $clubSection->setSport($this->getReference($sportRef, Sport::class));
                $manager->persist($clubSection);
            }
        }

        // Flush all sections to the database
        $manager->flush();
    }

    /**
     * Określa zależności (najpierw tworzymy kluby).
     */
    public function getDependencies(): array
    {
        return [
            ClubFixtures::class,
            SportFixtures::class,
        ];
    }

}

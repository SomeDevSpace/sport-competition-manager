<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create an array of the biggest Polish multi-sport clubs
        $clubsData = [
            [
                'name' => 'Legia Warszawa',
                'city' => 'Warszawa',
                'reference' => 'club_legia',
            ],
            [
                'name' => 'Lech Poznań',
                'city' => 'Poznań',
                'reference' => 'club_lech',
            ],
            [
                'name' => 'Wisła Kraków',
                'city' => 'Kraków',
                'reference' => 'club_wisla',
            ],
            [
                'name' => 'Śląsk Wrocław',
                'city' => 'Wrocław',
                'reference' => 'club_slask',
            ],
            [
                'name' => 'Górnik Zabrze',
                'city' => 'Zabrze',
                'reference' => 'club_gornik',
            ],
            [
                'name' => 'KS Świt',
                'city' => 'Starachowice',
                'reference' => 'club_ks_swit',
            ]
        ];

        // Create and persist each club
        foreach ($clubsData as $data) {
            $club = new Club();
            $club->setName($data['name']);
            $club->setCity($data['city']);
            $manager->persist($club);

            // Save reference for later use
            $this->addReference($data['reference'], $club);
        }

        // Flush clubs to the database
        $manager->flush();
    }
}

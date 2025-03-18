<?php

namespace App\DataFixtures;

use App\Entity\Competition;
use App\Entity\Sport;
use App\Enum\CompetitionFormat;
use App\Enum\CompetitionStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $competitionsData = [
            [
                'name' => 'Polish Shooting Cup 2025',
                'start_date' => new \DateTime('2025-05-10 12:00:00'),
                'end_date' => new \DateTime('2025-05-12 16:00:00'),
                'location' => 'Krakow Shooting Range',
                'description' => 'National shooting tournament for pistol events.',
                'sport' => 'sport_shooting',
                'format' => CompetitionFormat::INDIVIDUAL,
                'status' => CompetitionStatus::SCHEDULED,
                'isOpenForRegistration' => true,
            ],
            [
                'name' => 'National Cycling Championships 2025',
                'start_date' => new \DateTime('2025-07-01 10:00:00'),
                'end_date' => new \DateTime('2025-07-03 16:00:00'),
                'location' => 'Zakopane',
                'description' => 'Cycling races in mountain biking and road disciplines.',
                'sport' => 'sport_cycling',
                'format' => CompetitionFormat::INDIVIDUAL,
                'status' => CompetitionStatus::SCHEDULED,
                'isOpenForRegistration' => true,
            ],
            [
                'name' => 'Independence Run 2025',
                'start_date' => new \DateTime('2025-11-11 11:00:00'),
                'end_date' => new \DateTime('2025-11-11 20:00:00'),
                'location' => 'Warsaw',
                'description' => 'Mass run with 5K, 10K and Marathon events.',
                'sport' => 'sport_running',
                'format' => CompetitionFormat::INDIVIDUAL,
                'status' => CompetitionStatus::SCHEDULED,
                'isOpenForRegistration' => true,
            ],
        ];

        foreach ($competitionsData as $data) {
            $competition = new Competition();
            $competition->setName($data['name']);
            $competition->setStartDate($data['start_date']);
            $competition->setEndDate($data['end_date']);
            $competition->setLocation($data['location']);
            $competition->setDescription($data['description']);
            $competition->setFormat($data['format']);
            $competition->setStatus($data['status']);
            $competition->setIsOpenForRegistration($data['isOpenForRegistration']);

            // Set sport
            $competition->setSport($this->getReference($data['sport'], Sport::class));
            $manager->persist($competition);

            // Reference for later use
            $refKey = 'competition_' . strtolower(str_replace(' ', '_', $data['name']));
            $this->addReference($refKey, $competition);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SportFixtures::class,
            DisciplineFixtures::class
        ];
    }
}

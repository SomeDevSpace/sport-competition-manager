<?php

namespace App\DataFixtures;

use App\Entity\Competition;
use App\Entity\CompetitionDiscipline;
use App\Entity\Discipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetitionDisciplineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $compDisciplinesData = [
            // For Polish Shooting Cup 2025 (sport: Shooting)
            [
                'competition' => $this->getReference('competition_polish_shooting_cup_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_psp30', Discipline::class),
                'entry_fee'   => 50.00,
                'other_info'  => 'Information for PSP30'
            ],
            [
                'competition' => $this->getReference('competition_polish_shooting_cup_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_psp60', Discipline::class),
                'entry_fee'   => 60.00,
                'other_info'  => 'Information for PSP60'
            ],
            [
                'competition' => $this->getReference('competition_polish_shooting_cup_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_pcz30', Discipline::class),
                'entry_fee'   => 55.00,
                'other_info'  => 'Information for PCZ30'
            ],

            // For National Cycling Championships 2025 (sport: Cycling)
            [
                'competition' => $this->getReference('competition_national_cycling_championships_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_mtb_50_km', Discipline::class),
                'entry_fee'   => 80.00,
                'other_info'  => 'Information for MTB 50 km'
            ],
            [
                'competition' => $this->getReference('competition_national_cycling_championships_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_road_100_km', Discipline::class),
                'entry_fee'   => 90.00,
                'other_info'  => 'Information for Road 100 km'
            ],

            // For Independence Run 2025 (sport: Running)
            [
                'competition' => $this->getReference('competition_independence_run_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_5k_run', Discipline::class),
                'entry_fee'   => 30.00,
                'other_info'  => 'Information for 5K Run',
            ],
            [
                'competition' => $this->getReference('competition_independence_run_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_10k_run', Discipline::class),
                'entry_fee'   => 40.00,
                'other_info'  => 'Information for 10K Run'
            ],
            [
                'competition' => $this->getReference('competition_independence_run_2025', Competition::class),
                'discipline'  => $this->getReference('discipline_marathon', Discipline::class),
                'entry_fee'   => 100.00,
                'other_info'  => 'Information for Marathon'
            ],
        ];

        foreach ($compDisciplinesData as $data) {
            $compDiscipline = new CompetitionDiscipline();
            $compDiscipline->setCompetition($data['competition']);
            $compDiscipline->setDiscipline($data['discipline']);
            $compDiscipline->setEntryFee($data['entry_fee']);
            $compDiscipline->setOtherInfo($data['other_info']);
            $manager->persist($compDiscipline);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CompetitionFixtures::class,
            DisciplineFixtures::class,
        ];
    }
}

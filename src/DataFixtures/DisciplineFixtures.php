<?php

namespace App\DataFixtures;

use App\Entity\Discipline;
use App\Entity\Sport;
use App\Enum\DisciplineUnit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DisciplineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $disciplinesData = [
            // Shooting disciplines
            ['name' => 'PSP30', 'description' => '30-shot sport pistol', 'sport' => 'sport_shooting', 'unit' => DisciplineUnit::POINTS],
            ['name' => 'PSP60', 'description' => '60-shot sport pistol', 'sport' => 'sport_shooting', 'unit' => DisciplineUnit::POINTS],
            ['name' => 'PCZ30', 'description' => '30-shot centerfire pistol', 'sport' => 'sport_shooting', 'unit' => DisciplineUnit::POINTS],

            // Cycling disciplines
            ['name' => 'MTB 50 km', 'description' => '50 km mountain bike race', 'sport' => 'sport_cycling', 'unit' => DisciplineUnit::SECONDS],
            ['name' => 'Road 100 km', 'description' => '100 km road race', 'sport' => 'sport_cycling', 'unit' => DisciplineUnit::SECONDS],

            // Running disciplines
            ['name' => '5K Run', 'description' => '5 km run', 'sport' => 'sport_running', 'unit' => DisciplineUnit::SECONDS],
            ['name' => '10K Run', 'description' => '10 km run', 'sport' => 'sport_running', 'unit' => DisciplineUnit::SECONDS],
            ['name' => 'Marathon', 'description' => 'Marathon 42.195 km', 'sport' => 'sport_running', 'unit' => DisciplineUnit::SECONDS],
        ];

        foreach ($disciplinesData as $data) {
            $discipline = new Discipline();
            $discipline->setName($data['name']);
            $discipline->setUnit($data['unit']);
            $discipline->setDescription($data['description'] ?? null);

            // Sport relation set
            $discipline->setSport($this->getReference($data['sport'], Sport::class));
            $manager->persist($discipline);

            // Reference for later use
            $this->addReference('discipline_' . strtolower(str_replace(' ', '_', $data['name'])), $discipline);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SportFixtures::class,
        ];
    }
}

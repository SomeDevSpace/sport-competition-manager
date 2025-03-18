<?php

namespace App\Tests\Controller;

use App\Entity\Competition;
use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RegistrationControllerTest extends WebTestCase
{
    public function testIndex(CompetitionRepository $competitionRepository): void
    {
        $client = static::createClient();
        $competition = $competitionRepository->findOneBy([]);
        $client->request('GET', '/registration');

        self::assertResponseIsSuccessful();
    }
}

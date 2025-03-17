<?php

namespace App\Controller;

use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CompetitionController extends AbstractController
{
    #[Route('/competition', name: 'user_competition')]
    public function index(CompetitionRepository $competitionRepository): Response
    {
        $competitions = $competitionRepository->findAll();

        return $this->render('competition/index.html.twig', [
            'competitions' => $competitions,
        ]);
    }
}

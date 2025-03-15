<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
        ]);
    }

    #[Route('/dashboard_test', name: 'app_dashboard_test')]
    public function test(): Response
    {
        return $this->render('dashboard/index.html.twig', [
        ]);
    }
}

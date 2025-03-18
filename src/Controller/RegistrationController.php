<?php

namespace App\Controller;

use App\Entity\Competition;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration/{slug}', name: 'app_registration')]
    public function index(
        #[MapEntity(mapping: ['slug' => 'slug'])]
        Competition $competition
    ): Response
    {
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}

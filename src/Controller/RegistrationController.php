<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Player;
use App\Entity\PlayerClubSection;
use App\Form\DisciplinesSelectionFormType;
use App\Form\PlayerClubSectionFormType;
use App\Form\PlayerDetailsFormType;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly RequestStack $requestStack,
    )
    {
    }

    #[Route('/registration/summary', name: 'app_competition_registration_summary')]
    public function summary(): Response
    {
        $player = $this->requestStack->getSession()->get('app_competition_registration_player');
        $clubSection = $this->requestStack->getSession()->get('app_competition_registration_club_section');
        $disciplines = $this->requestStack->getSession()->get('app_competition_registration_disciplines');
        $competition = $this->requestStack->getSession()->get('app_competition_registration_competition');

        dump($player);
        dump($clubSection);
        dump($disciplines);
        dump($competition);

        return $this->render('registration/summary.html.twig', [
            'player' => $player,
            'clubSection' => $clubSection,
            'disciplines' => $disciplines['disciplines'],
            'competition' => $competition,
        ]);
    }

    #[Route('/registration/{slug}/{step}', name: 'app_competition_registration')]
    public function index(
        #[MapEntity(mapping: ['slug' => 'slug'])]
        Competition $competition,
        Request     $request,
        int         $step = 1
    ): Response
    {
        // Check if competition is open
        if (!$competition->isOpenForRegistration()) {
            return $this->render('registration/registration_closed.html.twig');
        }

        $form = match ($step) {
            1 => $this->createForm(PlayerDetailsFormType::class),
            2 => $this->createForm(PlayerClubSectionFormType::class, null, ['competition' => $competition]),
            3 => $this->createForm(DisciplinesSelectionFormType::class, null, ['competition' => $competition]),
        };

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return match ($step) {
                1 => $this->handlePlayerDetailsForm($form, $competition),
                2 => $this->handleClubSectionForm($form, $competition),
                3 => $this->handleDisciplinesForm($form, $competition),
                default => $this->redirectToRoute('app_competition_registration', ['slug' => $competition->getSlug()]),
            };
        }



//        $form = match($step) {
//            1 => $this->createForm(PlayerDetailsFormType::class),
//            2 => $this->createForm(PlayerDetailsFormType::class),
//            default => $this->redirectToRoute('app_competition_registration', ['slug' => $competition->getSlug()]),
//        };
//
//        $form->handleRequest($request);
//
//        if($form->isSubmitted() && $form->isValid()) {
//            return match(true) {
//                $step === 1 => $this->handlePlayerDetailsForm($form)
//            }
//        }

        return $this->render('registration/index.html.twig', [
            'competition' => $competition,
            'form' => $form
        ]);
    }

    private function handlePlayerDetailsForm(FormInterface $form, Competition $competition): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $this->requestStack->getSession()->set('app_competition_registration_player', $form->getData());
        return $this->redirectToRoute('app_competition_registration', [
            'slug' => $competition->getSlug(),
            'step' => 2,
        ]);
    }

    private function handleClubSectionForm(FormInterface $form, Competition $competition): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $this->requestStack->getSession()->set('app_competition_registration_club_section', $form->getData());
        return $this->redirectToRoute('app_competition_registration', [
            'slug' => $competition->getSlug(),
            'step' => 3,
        ]);
    }

    private function handleDisciplinesForm(FormInterface $form, Competition $competition)
    {
        $this->requestStack->getSession()->set('app_competition_registration_disciplines', $form->getData());
        $this->requestStack->getSession()->set('app_competition_registration_competition', $competition);
        return $this->redirectToRoute('app_competition_registration_summary');
    }
}

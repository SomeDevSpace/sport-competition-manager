<?php

namespace App\Form;

use App\Entity\ClubSection;
use App\Entity\Competition;
use App\Entity\Player;
use App\Entity\PlayerClubSection;
use App\Repository\ClubSectionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerClubSectionFormType extends AbstractType
{
    public function __construct(
        private readonly ClubSectionRepository $clubSectionRepository
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clubSection', EntityType::class, [
                'required' => false,
                'class' => ClubSection::class,
                'label' => 'Club',
//                'choice_label' => fn(ClubSection $clubSection) => sprintf(
//                    '%s -> %s',
//                    $clubSection->getClub()->getName(),
//                    $clubSection->getSport()->getName()
//                ),
                'placeholder' => 'No club',
                'choice_label' => fn(ClubSection $clubSection) => $clubSection->getClub()->getName(),
                'choices' => $this->clubSectionRepository->findBySport($options['competition']->getSport()),
            ])
            ->add('licenseNo', null, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => PlayerClubSection::class,
                'competition' => null,
            ])
            ->setAllowedTypes('competition', Competition::class);
    }
}

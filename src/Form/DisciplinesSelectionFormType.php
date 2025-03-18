<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\CompetitionDiscipline;
use App\Entity\Discipline;
use App\Repository\CompetitionDisciplineRepository;
use App\Repository\DisciplineRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisciplinesSelectionFormType extends AbstractType
{
    public function __construct(
        private readonly CompetitionDisciplineRepository $competitionDisciplineRepository,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('disciplines', EntityType::class, [
                'class' => Discipline::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choose disciplines',
                'choices' => array_map(
                    fn(CompetitionDiscipline $competitionDiscipline) => $competitionDiscipline->getDiscipline(),
                    $this->competitionDisciplineRepository->findByCompetition($options['competition'])
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => null,
                'competition' => null,
            ])
            ->setAllowedTypes('competition', Competition::class);
    }
}

<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\PlayerClubSection;
use App\Enum\Gender;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class PlayerDetailsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'data' => 'Test name'
            ])
            ->add('lastName', null, [
                'data' => 'Test lastname'
            ])
            ->add('email', null, [
                'data' => 'test@email.com'
            ])
            ->add('birthDate', null, [
                'data' => new \DateTime('1988-02-12'),
                'widget' => 'single_text',
            ])
            ->add('gender', EnumType::class, [
                'class' => Gender::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}

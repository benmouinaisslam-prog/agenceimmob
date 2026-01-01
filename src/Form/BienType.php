<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'House' => 'house',
                    'Apartment' => 'apartment',
                ],
            ])
            ->add('prix')
            ->add('surface')
            ->add('adresse')
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'For sale' => 'sale',
                    'Sold' => 'sold',
                    'Rent' => 'rent',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('email')
            ->add('type', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Acheteur' => 'acheteur',
                    'Vendeur' => 'vendeur',
                    'Propriétaire' => 'proprietaire',
                    'Locataire' => 'locataire',
                ],
            ])
            ->add('preferences', TextareaType::class, [
                'required' => false,
                'help' => 'JSON ou texte libre (budget, localisation, type)'
            ])
            ->add('isVerified', CheckboxType::class, [
                'required' => false,
                'label' => 'Email vérifié'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}

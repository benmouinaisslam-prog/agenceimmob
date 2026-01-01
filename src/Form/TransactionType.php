<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Client;
use App\Entity\Transaction;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Vente' => 'vente',
                    'Location' => 'location',
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Initiée' => 'initie',
                    'En cours' => 'en_cours',
                    'Signée' => 'signee',
                    'Annulée' => 'annulee',
                ],
            ])
            ->add('mode', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'En ligne' => 'en_ligne',
                    'Agence' => 'agence',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('prix')
            ->add('commissionAgence', null, ['required' => false])
            ->add('fraisNotaire', null, ['required' => false])
            ->add('canal', null, ['required' => false])
            ->add('commentaire', TextareaType::class, ['required' => false])
            ->add('bien', EntityType::class, [
                'class' => Bien::class,
                'choice_label' => 'titre',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'email',
            ])
            ->add('agent', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}

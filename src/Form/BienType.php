<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Maison' => 'house',
                    'Appartement' => 'apartment',
                    'Terrain' => 'land',
                    'Bureau' => 'office',
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Disponible' => 'disponible',
                    'Sous offre' => 'sous_offre',
                    'Vendu' => 'vendu',
                    'Loué' => 'loue',
                ],
            ])
            ->add('prix')
            ->add('localisation')
            ->add('ascenseur', null, ['required' => false])
            ->add('parking', null, ['required' => false])
            ->add('contactVendeur', null, [
                'required' => false,
                'label' => 'Contact vendeur',
                'help' => 'Téléphone ou email du vendeur',
            ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo principale',
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

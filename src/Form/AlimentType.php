<?php

namespace App\Form;

use App\Entity\Aliment;
use App\Entity\CategorieAliment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('nom', null, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Entrez le nom de l’aliment'
                    ]
                ])
                ->add('unite', ChoiceType::class, [
                    'label' => false,
                    'choices' => [
                        'Grammes (g)' => 'g',
                        'Kilogrammes (kg)' => 'kg',
                        'Millilitres (ml)' => 'ml',
                        'Litres (l)' => 'l',
                        'Pièce (pcs)' => 'pcs',
                    ],
                    'placeholder' => 'Sélectionnez une unité',
                    'required' => true,
                ])
                ->add('categorie', EntityType::class, [
                    'class' => CategorieAliment::class,
                    'choice_label' => 'nom',
                    'label' => false,
                    'placeholder' => 'Sélectionnez une catégorie',
                    'multiple' => false,
                    'required' => false
                ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}

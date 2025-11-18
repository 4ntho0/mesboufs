<?php

namespace App\Form;

use App\Entity\CategorieRepa;
use App\Entity\Repa;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('datecreation', DateType::class, [
                'widget' => 'single_text',
                'data' => isset($options['data']) &&
                    $options['data']->getDatecreation() != null ? $options['data']->getDateCreation() : new DateTime('now'),
                'label' => 'Date'
            ])
            ->add('instruction')
            ->add('note', null,[
                'label' => 'Note /20 : '
            ])
            
            ->add('duree', null,[
                'label' => 'Durée (en min) : '
            ])
            ->add('categories', EntityType::class, [
                'class' => CategorieRepa::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregister'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Repa::class,
        ]);
    }
}

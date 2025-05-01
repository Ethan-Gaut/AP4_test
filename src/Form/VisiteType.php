<?php

namespace App\Form;

use App\Entity\Visite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datePrevue', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date prévue'
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée (en minutes)'
            ])
            ->add('compteRenduInfirmiere', TextType::class, [
                'label' => 'Compte-rendu Infirmière',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visite::class,
        ]);
    }
}

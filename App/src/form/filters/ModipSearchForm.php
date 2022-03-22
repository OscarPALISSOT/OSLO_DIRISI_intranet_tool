<?php

namespace App\form\filters;

use App\Data\SearchDataModip;
use App\Entity\Organisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModipSearchForm extends AbstractType
{
    public function __construct()
    {
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sqdfzz = 0;
        if ( $sqdfzz > 0){
            $maxMontant = 'test';
            $minMontant = 'test';
            $min = $minMontant[0]['montantFeb'];
            $max = $maxMontant[0]['montantFeb'];
        }
        else{
            $min = 0;
            $max = 50000;
        }
        $builder
            ->add('Bnr', TextType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],

            ])

            ->add('idOrganisme', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Organisme::class,
                'placeholder' => 'Organisme',
                'expanded' => true,
                'multiple' => true

            ])

            ->add('before', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => "Avant ou après l'échéance ?",
                'choices' => [
                    'Avant' => true,
                    'Après' => false,
                ],
            ])

            ->add('Echeance', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
            ])

            ->add('supMontant', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => "Supérieur ou inférieur au montant ?",
                'choices' => [
                    'Supérieur' => true,
                    'Inférieur' => false,
                ],
            ])

            ->add('Montant', RangeType::class, [

                'label' => false,
                'required' => false,
                'attr' => [
                    'min' => $min,
                    'max' => $max,
                    'value' => $min,
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchDataModip::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
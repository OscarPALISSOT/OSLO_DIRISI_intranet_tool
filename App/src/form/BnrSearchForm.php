<?php

namespace App\form;

use App\Data\SearchDataBnr;
use App\Entity\Organisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BnrSearchForm extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'placeholder' => 'Organisme',
                ],

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchDataBnr::class,
            'method' => 'POST',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
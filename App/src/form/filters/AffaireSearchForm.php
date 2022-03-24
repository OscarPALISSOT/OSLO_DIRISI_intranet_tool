<?php

namespace App\form\filters;

use App\Data\SearchDataAffaire;
use App\Entity\BasesDeDefense;
use App\Entity\Organisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffaireSearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idOrganisme', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Organisme::class,
                'expanded' => true,
                'multiple' => true

            ])

            ->add('idBaseDeDefense', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => BasesDeDefense::class,
                'placeholder' => 'Base de défense',
                'expanded' => true,
                'multiple' => true

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchDataAffaire::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

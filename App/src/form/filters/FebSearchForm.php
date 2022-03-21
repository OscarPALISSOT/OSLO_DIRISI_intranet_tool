<?php

namespace App\form\filters;

use App\Data\SearchDataFeb;
use App\Entity\PlanDeCharge;
use App\Repository\FebRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FebSearchForm extends AbstractType
{

    private FebRepository $febRepository;

    public function __construct(FebRepository $febRepository)
    {
        $this->febRepository = $febRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ( count($this->febRepository->findAll()) > 0){
            $maxMontant = $this->febRepository->findMaxMontant();
            $minMontant = $this->febRepository->findMinMontant();
            $min = $minMontant[0]['montantFeb'];
            $max = $maxMontant[0]['montantFeb'];
        }
        else{
            $min = 0;
            $max = 50000;
        }
        $builder
            ->add('Feb', TextType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],

            ])
            ->add('Pdc', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => PlanDeCharge::class,
                'expanded' => true,
                'multiple' => true

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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchDataFeb::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

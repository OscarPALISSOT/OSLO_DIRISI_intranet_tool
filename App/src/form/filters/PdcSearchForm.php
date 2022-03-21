<?php

namespace App\form\filters;

use App\Data\SearchDataPdc;
use App\Entity\EtatPdc;
use App\Entity\GrandsComptes;
use App\Entity\StatutPdc;
use App\Repository\PlanDeChargeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PdcSearchForm extends AbstractType
{

    private $planDeChargeRepository;

    public function __construct(PlanDeChargeRepository $planDeChargeRepository)
    {
        $this->planDeChargeRepository = $planDeChargeRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ( count($this->planDeChargeRepository->findAll()) > 0){
            $maxMontant = $this->planDeChargeRepository->findMaxMontant();
            $minMontant = $this->planDeChargeRepository->findMinMontant();
            $min = $minMontant[0]['montantPdc'];
            $max = $maxMontant[0]['montantPdc'];
        }
        else{
            $min = 0;
            $max = 50000;
        }
        $builder
            ->add('Pdc', TextType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],

            ])
            ->add('num', TextType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],

            ])
            ->add('StatutPdc', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => StatutPdc::class,
                'expanded' => true,
                'multiple' => true

            ])
            ->add('EtatPdc', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => EtatPdc::class,
                'expanded' => true,
                'multiple' => true

            ])
            ->add('GrandsComptes', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => GrandsComptes::class,
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
            'data_class' => SearchDataPdc::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

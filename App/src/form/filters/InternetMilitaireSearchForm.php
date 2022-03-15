<?php

namespace App\form\filters;

use App\Data\SearchDataInternetMilitaire;
use App\Repository\InternetMilitaireRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternetMilitaireSearchForm extends AbstractType
{
    private InternetMilitaireRepository $internetMilitaireRepository;

    public function __construct(InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->internetMilitaireRepository = $internetMilitaireRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ( count($this->internetMilitaireRepository->findAll()) > 0){
            $maxMontant = $this->internetMilitaireRepository->findMaxMontant();
            $minMontant = $this->internetMilitaireRepository->findMinMontant();
            $min = $minMontant[0]['montantInternetMilitaire'];
            $max = $maxMontant[0]['montantInternetMilitaire'];
        }
        else{
            $min = 0;
            $max = 50000;
        }
        $builder
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
            'data_class' => SearchDataInternetMilitaire::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

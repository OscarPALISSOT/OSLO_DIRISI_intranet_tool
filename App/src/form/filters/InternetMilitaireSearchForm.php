<?php

namespace App\form\filters;

use App\Data\SearchDataInternetMilitaire;
use App\Entity\BasesDeDefense;
use App\Entity\Organisme;
use App\Entity\Quartiers;
use App\Entity\SupportInternetMilitaire;
use App\Repository\InternetMilitaireRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternetMilitaireSearchForm extends AbstractType
{
    private $internetMilitaireRepository;

    public function __construct(InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->internetMilitaireRepository = $internetMilitaireRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ( count($this->internetMilitaireRepository->findAll()) > 0){
            $maxDebit = $this->internetMilitaireRepository->findMaxDebit();
            $minDebit = $this->internetMilitaireRepository->findMinDebit();
            $min = $minDebit[0]['debitInternetMilitaire'];
            $max = $maxDebit[0]['debitInternetMilitaire'];
        }
        else {
            $min = 0;
            $max = 50000;
        }

        $builder
            ->add('idOrganisme', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Organisme::class,
                'expanded' => true,
                'multiple' => true

            ])
            ->add('idSupport', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => SupportInternetMilitaire::class,
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

            ->add('idQuartier', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Quartiers::class,
                'placeholder' => 'Quatier',
                'expanded' => true,
                'multiple' => true

            ])

            ->add('supDebit', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => "Supérieur ou inférieur au debit ?",
                'choices' => [
                    'Supérieur' => true,
                    'Inférieur' => false,
                ],
            ])

            ->add('Debit', RangeType::class, [

                'label' => false,
                'required' => false,
                'attr' => [
                    'min' => $min,
                    'max' => $max,
                    'step' => 1000,
                    'value' => $min,
                    'class' => 'sliderRange'
                ],
            ]);
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

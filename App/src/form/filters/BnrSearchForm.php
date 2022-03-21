<?php

namespace App\form\filters;

use App\Data\SearchDataBnr;
use App\Entity\Organisme;
use App\Entity\Priorisation;
use App\Repository\AffaireRepository;
use App\Repository\InfoBnrRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BnrSearchForm extends AbstractType
{
    private $infoBnrRepository;
    private $affaireRepository;

    public function __construct(InfoBnrRepository $infoBnrRepository, AffaireRepository $affaireRepository)
    {
        $this->infoBnrRepository = $infoBnrRepository;
        $this->affaireRepository = $affaireRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ( count($this->infoBnrRepository->findAll()) > 0){
            $maxMontant = $this->affaireRepository->findMaxMontant();
            $minMontant = $this->affaireRepository->findMinMontant();
            $min = $minMontant[0]['montantAffaire'];
            $max = $maxMontant[0]['montantAffaire'];
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
                'expanded' => true,
                'multiple' => true

            ])

            ->add('Priority', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Priorisation::class,
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
            'data_class' => SearchDataBnr::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
<?php

namespace App\form\filters;

use App\Data\SearchDataInternetMilitaire;
use App\Entity\Organisme;
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

        $builder
            ->add('idOrganisme', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Organisme::class,
                'expanded' => true,
                'multiple' => true

            ])
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

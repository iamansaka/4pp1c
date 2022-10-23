<?php

namespace App\Form;

use App\Entity\Pets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('registryNumber')
            ->add('description')
            ->add('sexe')
            ->add('age')
            ->add('arrivedAtRefuge')
            ->add('isVaccinated')
            ->add('isSterilized')
            ->add('isAffinityDog')
            ->add('isAffinityCat')
            ->add('isAffinityChildren')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pets::class,
        ]);
    }
}

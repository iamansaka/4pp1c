<?php

namespace App\Form;

use App\Entity\MemberShip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberShipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $member = $builder->getData();

        $builder
            ->add('firstname', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Nom'
                ],
                'label' => 'Nom',
                'required' => false
            ])
            ->add('lastname', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Prénom'
                ],
                'label' => 'Prénom',
                'required' => false
            ])
            ->add('gender', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Sexe'
                ],
                'choices' => [
                    'Homme' => true,
                    'Femme' => false
                ],
                'data' => $member->isGender() ? true : false,
                'label' => 'Sexe',
                'required' => false
            ])
            ->add('age', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Age'
                ],
                'label' => 'Age',
                'required' => false
            ])
            ->add('mail', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'andre.antoinette@gmail.com'
                ],
                'label' => 'Adresse email',
                'required' => false
            ])
            ->add('phone', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '+336 00 00 00 00'
                ],
                'label' => 'Numéro de téléphone',
                'required' => false
            ])
            ->add('adress', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '1 rue des salades, Apt 8'
                ],
                'label' => 'Adresse',
                'required' => false
            ])
            ->add('zipCode', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '85100'
                ],
                'label' => 'Code postal',
                'required' => false
            ])
            ->add('city', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Le Boupère'
                ],
                'label' => 'Ville',
                'required' => false
            ])
            ->add('amount', null, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '10€'
                ],
                'label' => 'Montant adhésions',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MemberShip::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Pets;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $pet = $builder->getData();

        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Nom du chat(on)'
                ],
                'label' => 'Nom',
                'required' => false
            ])
            ->add('registryNumber', TextType::class, [
                'label' => 'N° de registre',
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'N° de registre'
                ],
            ])
            ->add('thumbnail', FileType::class, [
                'attr' => [
                    'class' => 'form-field uploaded-area'
                ],
                'label' => 'Photo du chat(on)',
                'mapped' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Une petite description du chat(on)',
                    'rows' => 8
                ],
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'expanded' => true,
                'choices' => [
                    'Femelle' => false,
                    'Male' => true
                ],
                'data' => $pet->isSexe() ? true : false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'choice_attr' => function ($choice, $key, $value) {
                    return ['class' => 'form-check-input'];
                },
            ])
            ->add('age', null, [
                'label' => 'Age',
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => "Age du chat(on)"
                ]
            ])
            ->add('arrivedAtRefuge', DateType::class, [
                'label' => 'Arrivé au refuge',
                'required' => false,
                'widget' => 'single_text',
                'data' => new DateTime(),
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('isVaccinated', CheckboxType::class, [
                'label' => 'Vacciné',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'attr' => [
                    'class' => 'switch-check switch-icon'
                ]
            ])
            ->add('isSterilized', null, [
                'label' => 'Stérilisé',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'attr' => [
                    'class' => 'switch-check switch-icon'
                ]
            ])
            ->add('isAffinityDog', null, [
                'label' => 'Compatibilité chiens',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'attr' => [
                    'class' => 'switch-check switch-icon'
                ]
            ])
            ->add('isAffinityCat', null, [
                'label' => 'Compatibilité chats',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'attr' => [
                    'class' => 'switch-check switch-icon'
                ]
            ])
            ->add('isAffinityChildren', null, [
                'label' => 'Compatibilité enfants',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'attr' => [
                    'class' => 'switch-check switch-icon'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pets::class,
        ]);
    }
}

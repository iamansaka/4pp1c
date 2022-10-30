<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Nom du partenaire'
                ],
                'label' => 'Nom',
                'required' => false
            ])
            ->add('pictureFile', FileType::class, [
                'attr' => [
                    'class' => 'form-field uploaded-area'
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Une petite description',
                    'rows' => 7
                ],
                'label' => 'Description',
                'required' => false
            ])
            ->add('representativeName', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Andre Antoinette'
                ],
                'label' => 'Nom du représentant',
                'required' => false
            ])
            ->add('representativeMail', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'andre.antoinette@gmail.com'
                ],
                'label' => 'Adresse mail du représentant',
                'required' => false
            ])
            ->add('representativePhone', TelType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '+336 00 00 00 00'
                ],
                // 'constraints' => [
                //     new Regex("(?:(?:\+|00)33|0)", 'Ce numéro de téléphone n\'est pas valide.',)
                // ],
                'label' => 'Téléphone du partenaire ou représentant',
                'required' => false
            ])
            ->add('adress', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => '123 rue des salades, 85510 Le Boupère'
                ],
                'label' => 'Adresse',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}

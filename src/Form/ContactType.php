<?php

namespace App\Form;


use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-field'
                ],
                'required' => false
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-field'
                ],
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-field'
                ],
                'required' => false
            ])
            ->add('subjet', TextType::class, [
                'label' => 'Sujet de votre question',
                'attr' => [
                    'class' => 'form-field'
                ],
                'required' => false
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'class' => 'form-field',
                    'rows' => 8
                ],
                'required' => false
            ])
            ->add('copy', CheckboxType::class, [
                'label' => 'Copie message',
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

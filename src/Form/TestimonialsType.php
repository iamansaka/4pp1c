<?php

namespace App\Form;

use App\Entity\Testimonials;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestimonialsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-field'
                ],
                'label' => 'Mon témoignage',
                'required' => false
            ])
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-field'
                ],
                'label' => 'Mon nom',
                'required' => false
            ])
            ->add('email', null, [
                'attr' => [
                    'class' => 'form-field'
                ],
                'label' => 'Mon adresse email',
                'required' => false
            ])
            ->add('rating', HiddenType::class, [
                'attr' => ['class' => 'rating'],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Testimonials::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Titre de l\'article'
                ],
                'label' => 'Titre'
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'class' => 'form-field article-slug',
                    'placeholder' => 'Url de l\'article'
                ],
                'label' => 'Url',
                'disabled' => true
            ])
            ->add('summary', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Accroche de l\'article'
                ],
                'label' => 'Accroche'
            ])
            ->add('isPublished', ChoiceType::class, [
                // 'attr' => [
                //     'class' => 'form-check-input',
                // ],
                'expanded' => true,
                'choices' => [
                    'Brouillon' => false,
                    'Publié' => true
                ],
                'choice_attr' => function ($choice, $key, $value) {
                    return ['class' => 'form-check-input'];
                },
                'data' => false,
                'label' => 'Status de l\'article'
            ])
            ->add('content', CKEditorType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Contenu de l\'article'
                ],
                'label' => 'Contenu'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

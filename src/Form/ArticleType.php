<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $article = $builder->getData();

        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Titre de l\'article'
                ],
                'label' => 'Titre',
                'required' => false
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'class' => 'form-field article-slug',
                    'placeholder' => 'Url de l\'article'
                ],
                'label' => 'Url',
                'disabled' => true,
                'required' => false
            ])
            ->add('pictureFile', FileType::class, [
                'attr' => [
                    'class' => 'form-field uploaded-area'
                ],
                'label' => 'Image à la une',
                'mapped' => false,
                'required' => false
            ])
            ->add('summary', TextType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Accroche de l\'article'
                ],
                'label' => 'Accroche',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Categorie',
                'placeholder' => 'Categorie...',
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => false
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
                'data' => $article->isIsPublished() ? $article->isIsPublished() : false,
                'label' => 'Status de l\'article',
            ])
            ->add('content', CKEditorType::class, [
                'attr' => [
                    'class' => 'form-field',
                    'placeholder' => 'Contenu de l\'article'
                ],
                'label' => 'Contenu',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

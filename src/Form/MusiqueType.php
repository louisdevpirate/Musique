<?php

namespace App\Form;

use App\Entity\Musique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MusiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre de la musique',
                    'class' => 'form-field',
                ]
            ])

            ->add('artist', TextType::class, [
                'attr' => [
                    'placeholder' => 'Artiste',
                    'class' => 'form-field',
                ]
            ])

            ->add('genre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Genre',
                    'class' => 'form-field',
                ]
            ])

            ->add('release_date', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musique::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Musique;
use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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

            ->add('genre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Genre',
                    'class' => 'form-field',
                ]
            ])

            ->add('release_date', IntegerType::class)

            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musique::class,
            'user_id' => null,
        ]);
    }
}

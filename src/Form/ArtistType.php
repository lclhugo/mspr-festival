<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom* :',
                'required' => true,
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => [
                    'rows' => 10,
                ],
            ])
            ->add('musicgenres', EntityType::class, [
                'class' => 'App\Entity\MusicGenre',
                'choice_label' => 'name',
                'label' => 'Genre musical',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}

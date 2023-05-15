<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , [
                'label' => 'Nom',
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
                'label' => 'Date de début',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
                'label' => 'Date de fin',
            ])
            ->add('artistId', EntityType::class, [
                'class' => 'App\Entity\Artist',
                'choice_label' => 'name',
                'label' => 'Artiste',
            ])
            ->add('festivalId', EntityType::class, [
                'class' => 'App\Entity\Festival',
                'choice_label' => 'name',
                'label' => 'Festival',
            ])
            ->add('categoryId', EntityType::class, [
                'class' => 'App\Entity\EventCategory',
                'choice_label' => 'name',
                'label' => 'Catégorie',
            ])
            ->add('locationId', EntityType::class, [
                'class' => 'App\Entity\Location',
                'choice_label' => 'name',
                'label' => 'Lieu',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

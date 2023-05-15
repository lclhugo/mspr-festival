<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('startDate')
            ->add('endDate')
            ->add('artistId', EntityType::class, [
                'class' => 'App\Entity\Artist',
                'choice_label' => 'name',
            ])
            ->add('festivalId', EntityType::class, [
                'class' => 'App\Entity\Festival',
                'choice_label' => 'name',
            ])
            ->add('categoryId', EntityType::class, [
                'class' => 'App\Entity\EventCategory',
                'choice_label' => 'name',
            ])
            ->add('locationId', EntityType::class, [
                'class' => 'App\Entity\Location',
                'choice_label' => 'name',
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

<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , [
                'label' => 'Nom* :',
                'required' => true,
            ])
            ->add('startDate', DateTimeType::class, [
                'label' => 'Date de début* :',
                'widget' => 'single_text',
                'required' => true,
                'attr' => ['min' => (new \DateTime())->format('D-m-Y H:i'),
                    'class' => 'form-control',
                ],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin* :',
                'required' => true,
                'attr' => ['min' => (new \DateTime())->modify('+1 day')->format('D-m-Y H:i'),
                    'class' => 'form-control',],
            ])
            ->add('artist', EntityType::class, [
                'class' => 'App\Entity\Artist',
                'choice_label' => 'name',
                'label' => 'Artiste* :',
                'required' => true,

            ])
            ->add('category', EntityType::class, [
                'class' => 'App\Entity\EventCategory',
                'choice_label' => 'name',
                'label' => 'Catégorie* :',
                'required' => true,
            ])
            ->add('location', EntityType::class, [
                'class' => 'App\Entity\Location',
                'choice_label' => 'name',
                'label' => 'Lieu* :',
                'required' => true,
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

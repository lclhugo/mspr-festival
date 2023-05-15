<?php

namespace App\Form;

use App\Entity\Festival;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('startDate', DateTimeType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => ['min' => ( new \DateTime() )->format('Y-m-d H:i')],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'attr' => ['min' => ( new \DateTime() )->modify('+1 day')->format('Y-m-d H:i')],
            ])
            //textarea
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('image')
            ->add('organizer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}

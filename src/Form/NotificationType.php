<?php

namespace App\Form;

use App\Entity\Notification;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',
                null,
                [
                    'label' => 'Titre* :',
                    'required' => true,
                ]
            )
            ->add('content',
                null,
                [
                    'label' => 'Contenu :',
                    'attr' => [
                        'rows' => 10,
                    ],
                ]
            )
            ->add('important', null, [
                'label' => 'Important ?',
                'required' => false,
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
        ]);
    }
}

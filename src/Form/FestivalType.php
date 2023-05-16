<?php

namespace App\Form;

use App\Entity\Festival;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                    'label' => 'Nom* :',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un nom pour le festival',
                        ]),
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'required' => true,
                ]
            )
            ->add('startDate', DateTimeType::class, [
                'label' => 'Date de début* :',
                'widget' => 'single_text',
                'attr' => ['min' => (new \DateTime())->format('Y-m-d H:i'),
                    'class' => 'form-control',
                ],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin* :',
                'attr' => ['min' => (new \DateTime())->modify('+1 day')->format('Y-m-d H:i'),
                    'class' => 'form-control',],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description* :',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '5',
                    'maxlength' => '2000',
                ],
            ])
            ->add('image', TextType::class, [
                'label' => 'Image :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
            ])
            ->add('organizer', TextType::class, [
                'label' => 'Organisateur :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Choice;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("name", TextType::class, [
                'required' => true,
                'label' => "Nom",
                'constraints' => [
                    new Assert\Length(min: 3, max: 255)
                ]
            ])
            ->add("description", TextType::class, [
                'required' => true,
                'label' => "Description",
                'constraints' => [
                    new Assert\Length(min: 3, max: 255)
                ]
            ])
            ->add("monthlyPrice", IntegerType::class, [
                'required' => true,
                'label' => "Prix Mensuel",
                'constraints' => [
                    new Assert\Range([
                        'min' => 1,
                        'max' => 10000,
                        'notInRangeMessage' => 'Value must be between {{ min }} and {{ max }}.',
                    ])
                ]
            ])
            ->add("dailyPrice", IntegerType::class, [
                'required' => true,
                'label' => "Prix Journalier",
                'constraints' => [
                    new Assert\Range([
                        'min' => 1,
                        'max' => 1000,
                        'notInRangeMessage' => 'Value must be between {{ min }} and {{ max }}.',
                    ])
                ]
            ])
            ->add("places", IntegerType::class, [
                'required' => true,
                'label' => "Places",
                'constraints' => [
                    new Assert\Range([
                        'min' => 1,
                        'max' => 9,
                        'notInRangeMessage' => 'Value must be between {{ min }} and {{ max }}.',
                    ])
                ]
            ])
            ->add('manual', ChoiceType::class, [
                'required' => true,
                'label' => "Vitesse",
                'choices' => [
                    'Manuelle' => 'manual',
                    'Automatique' => 'auto',
                ],
                'constraints' => [
                    new Choice(['choices' => ['manual', 'auto'], 'message' => 'Le champ motor doit être soit "manual" soit "auto".']),
                ],
            ])
            ->add('save', SubmitType::class,  [
                'label' => 'envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'car_token',
        ]);
    }
}
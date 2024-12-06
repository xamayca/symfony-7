<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'mapped' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom d\'utilisateur'
                ],
            ])
            ->add('email', EmailType::class, [
                'mapped' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('password', repeatedType::class, [
                'mapped' => true,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmez le mot de passe'
                    ]
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'J\'accepte les termes et conditions',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

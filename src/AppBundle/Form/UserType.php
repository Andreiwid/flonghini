<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email:',
                    'label_attr' => [
                        'class' => 'form-control-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Digite o email',
                        'maxlength' => '255',
                    ],
                    'required' => true
                ]
            )
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Nome do usuário:',
                    'label_attr' => [
                        'class' => 'form-control-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Digite o nome do usuário',
                        'maxlength' => '255',
                    ],
                    'required' => true,
                    'mapped' => false
                ]
            )
            ->add('plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => [
                        'label' => 'Senha'
                    ],
                    'second_options' => [
                        'label' => 'Repetir senha'
                    ],
                    'label_attr' => [
                        'class' => 'form-control-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_user_type';
    }
}

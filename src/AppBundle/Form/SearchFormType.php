<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'param',
                TextType::class,
                [
                    'label_attr' => [
                        'class' => 'form-control-label',
                    ],
                    'attr' => [
                        'class' => 'header-search pull-right',
                        'placeholder' => 'Busca',
                        'maxlength' => '255',
                    ],
                    'required' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'search_form';
    }
}

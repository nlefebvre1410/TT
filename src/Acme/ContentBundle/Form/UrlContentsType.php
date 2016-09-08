<?php

namespace Acme\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Acme\ContentBundle\Entity\Content;

class UrlContentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('content', 'collection', [
                'type' => new ContentType(),
                'prototype' => true,

                'label'=> false,
                'allow_add' => true,
                'allow_delete' => true
            ])

        ;


    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\ContentBundle\Entity\UrlContents'
        ));
    }
}

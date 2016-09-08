<?php

namespace Cz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicesAccueilType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('icons1')
            ->add('title1')
            ->add('descriptif1')
            ->add('icons2')
            ->add('title2')
            ->add('descriptif2')
            ->add('icons3')
            ->add('title3')
            ->add('descriptif3')
            ->add('icons4')
            ->add('title4')
            ->add('descriptif4')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cz\AdminBundle\Entity\ServicesAccueil'
        ));
    }
}

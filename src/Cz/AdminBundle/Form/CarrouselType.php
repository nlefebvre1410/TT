<?php

namespace Cz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarrouselType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('slides', CollectionType::class, array(
            'entry_type' => SlideType::class,
            'allow_add'    => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label'=> false
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cz\AdminBundle\Entity\Carrousel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cz_adminbundle_carrousel';
    }
}

<?php

namespace Cz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SlideType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', 'a2lix_translations',array('label'=> false))
        ->add('format',ChoiceType::class,array(
//            'attr'=>array(
//                'class'=>'col-lg-7'
//            ),
            'choices'=> array(
                    0 => 'Normal',
                    1 => 'Pleine largueur')
            )
        )
        ->add('fleches')
        ->add('image',new MediaAdminType()
);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cz\AdminBundle\Entity\Slide'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cz_adminbundle_slide';
    }
}

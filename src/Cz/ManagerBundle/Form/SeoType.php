<?php

namespace Cz\ManagerBundle\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeoType extends AbstractType
{
    const ROBOTS_NOINDEX = "noindex";
    const ROBOTS_NOFOLLOW = "nofollow";
    const ROBOTS_NOARCHIVE = "noarchive";
    const ROBOTS_NOSNIPPET = "nosnippet";
    const ROBOTS_NOTRANSLATE = "notranslate";
    const ROBOTS_NOIMAGEINDEX = "noimageindex";

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('translations',TranslationsType::class,array(
                 'label'=> false,
                'locales' => ['fr', 'en'],
                'default_locale' => ['fr']   ,
                 'required_locales' => ['fr'],
                    'fields' => array(
                        'metaTitle'=>array(
                            'field_type' => null,
                            'label' => 'Titre',
                            'attr' => array(
                                'info_text' => 'La balise de titre est souvent utilisé sur des moteurs de recherche les pages de résultats . Elle doit être inférieure à 55 caractères',
                                'maxlength' => 55 )
                                                    ),

                        'metaDescription'=> array(
                            'field_type' => null,
                            'label' => 'Meta description',
                            'attr' => array(
                                'maxlength' => 155)
                                                        ),
                        'metaRobots'=>array(
                            'field_type' =>  ChoiceType::class,
                            'choices' => array(
                                'seo.form.robots.noindex'      => self::ROBOTS_NOINDEX,
                                'seo.form.robots.nofollow'     => self::ROBOTS_NOFOLLOW,
                                'seo.form.robots.noarchive'    => self::ROBOTS_NOARCHIVE,
                                'seo.form.robots.nosnippet'    => self::ROBOTS_NOSNIPPET,
                                'seo.form.robots.notranslate'  => self::ROBOTS_NOTRANSLATE,
                                'seo.form.robots.noimageindex' => self::ROBOTS_NOIMAGEINDEX,
                            ),
                            'choices_as_values' => true,
                            'required' => false,
                            'multiple' => true,
                            'expanded' => false,
                            'label' => 'Meta robots',
                            'attr' => array(
                                'placeholder' => 'seo.form.seo.meta_robots.placeholder',
                                'class' => 'js-advanced-select form-control',
                                'maxlength' => 255
                            )

                        )

                     ),



                    'exclude_fields' =>
                        array('ogType','ogTitle','ogDescription','ogUrl',
                              'ogArticleAuthor','ogArticlePublisher','ogArticleSection',
                                    'twitterTitle','twitterDescription','twitterSite','twitterCreator',
                            'extraMetadata'),)

            );


        $builder->get('translations')
            ->addModelTransformer(new CallbackTransformer(
                function ($original) {
                    // string to array
                    $array = explode(',', $original);
                    // trim all the values
                    $array = array_map('trim', $array);
                    return $array;
                },
                function ($submitted) {
                    // trim all the values
                    $value = array_map('trim', $submitted);
                    // join together
                    $string = implode(',', $value);
                    return $string;
                }
            ));
//        $builder->add('extraMetadata', TextareaType::class, array(
//            'label' => 'seo.form.seo.extra_metadata.label',
//            'required' => false,
//        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'seo';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Cz\ManagerBundle\Entity\Seo',
        ));
    }
}

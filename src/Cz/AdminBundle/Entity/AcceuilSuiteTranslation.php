<?php

namespace Cz\AdminBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="cz_adminbundle_acceuilsuite_translation")
 */
class AcceuilSuiteTranslation  implements OneLocaleInterface
{

    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;


    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text")
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="widget", type="text")
     */
    private $widget;


    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return ImageTranslation
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set widget
     *
     * @param string $widget
     *
     * @return ImageTranslation
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;

        return $this;
    }

    /**
     * Get widget
     *
     * @return string
     */
    public function getWidget()
    {
        return $this->widget;
    }
}

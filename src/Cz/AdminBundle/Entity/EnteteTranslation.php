<?php

namespace Cz\AdminBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entete
 *
 * @ORM\Table(name="cz_adminbundle_entete_translation")
 * @ORM\Entity()
 */
class EnteteTranslation implements OneLocaleInterface
{

    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
    /**
     * @var string
     *
     * @ORM\Column(name="sur_title", type="string", length=255)
     */
    private $surTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $introduction;

    /**
     * @return string
     */
    public function getSurTitle()
    {
        return $this->surTitle;
    }

    /**
     * @param string $surTitle
     */
    public function setSurTitle($surTitle)
    {
        $this->surTitle = $surTitle;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @param string $introduction
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
    }


}


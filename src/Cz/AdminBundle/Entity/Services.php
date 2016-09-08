<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Services
 *
 * @ORM\Table("cz_adminbundle_service")
 * @ORM\Entity
 */
class Services
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="icons", type="string", length=255)
     */
    private $icons;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set icons
     *
     * @param string $icons
     *
     * @return Services
     */
    public function setIcons($icons)
    {
        $this->icons = $icons;

        return $this;
    }

    /**
     * Get icons
     *
     * @return string
     */
    public function getIcons()
    {
        return $this->icons;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Services
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}


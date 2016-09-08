<?php

namespace Cz\AdminBundle\Entity;

use Cz\ManagerBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Cz\AdminBundle\Entity\Carrousel;

/**
 * Namec
 *
 * @ORM\Table(name="cz_adminbundle_carrousel_name")
 * @ORM\Entity(repositoryClass="Cz\AdminBundle\Repository\CarrouselRepository")
 */
class Namec extends AbstractEntity
{

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $lang;

//    /**
//     * @var Namecs $namecs
//     *
//     * @ORM\ManyToOne(targetEntity="Cz\AdminBundle\Entity\Carrousel", inversedBy="namecs", cascade={"persist", "merge"})
//     * @ORM\JoinColumns({
//     *  @ORM\JoinColumn(name="Carrousel_id", referencedColumnName="id")
//     * })
//     */
//    protected $carrousel;
//
//
    /**
     * Bidirectional - Many comments are favorited by many users (INVERSE SIDE)
     *
     * @ORM\ManyToMany(targetEntity="Cz\AdminBundle\Entity\Carrousel", mappedBy="namecs")
     */
    private $carrousel;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->carrousel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Namec
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Namec
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }
//
//    /**
//     * Add carrousel
//     *
//     * @param \Cz\AdminBundle\Entity\Carrousel $carrousel
//     *
//     * @return Namec
//     */
//    public function addCarrousel(\Cz\AdminBundle\Entity\Carrousel $carrousel)
//    {
//        $this->carrousel[] = $carrousel;
//
//        return $this;
//    }

    /**
     * Remove carrousel
     *
     * @param \Cz\AdminBundle\Entity\Carrousel $carrousel
     */
    public function removeCarrousel(\Cz\AdminBundle\Entity\Carrousel $carrousel)
    {
        $this->carrousel->removeElement($carrousel);
    }

    /**
     * Get carrousel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarrousel()
    {
        return $this->carrousel;
    }
    public function addCarrousel(C $tag)
    {
        $this->tags->add($tag);
    }
}

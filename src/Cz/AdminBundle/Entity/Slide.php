<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Carrousel
 *
 * @ORM\Table(name="cz_adminbundle_slide")
 * @ORM\Entity()
 */
class Slide
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Cz\AdminBundle\Entity\MediaAdmin", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="boolean")
     */
    private $format;
    /**
     * @var string
     *
     * @ORM\Column(name="fleches", type="boolean")
     */
    private $fleches;


    /**
     * @ORM\ManyToOne(targetEntity="Carrousel", inversedBy="slides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carrousel;


    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();

    }

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
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFleches()
    {
        return $this->fleches;
    }

    /**
     * @param string $fleches
     */
    public function setFleches($fleches)
    {
        $this->fleches = $fleches;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCarrousel()
    {
        return $this->carrousel;
    }

    /**
     * @param mixed $carrousel
     */
    public function setCarrousel($carrousel)
    {
        $this->carrousel = $carrousel;
    }


    public function addCarrousel(Carrousel $carrousel)
    {
        $this->carrousel = $carrousel;
    }





}

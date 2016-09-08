<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Carrousel
 *
 * @ORM\Table(name="cz_adminbundle_carrousel")
 * @ORM\Entity()
 */
class Carrousel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @ORM\OneToMany(targetEntity="Slide", mappedBy="carrousel", cascade={"persist","remove"})
     */
    private $slides;

    public function __construct()
    {
        $this->slides = new ArrayCollection();
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
     * @return mixed
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * @param mixed $slides
     */
    public function setSlides($slides)
    {
        $this->slides = $slides;
    }

    public function addSlide(Slide $slide)
    {
        $slide->addCarrousel($this);

        $this->slides->add($slide);
    }

    public function removeSlide(Slide $slide)
    {
        $this->slides->removeElement($slide);
    }


}

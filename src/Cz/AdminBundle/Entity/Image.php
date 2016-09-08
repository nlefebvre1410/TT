<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="cz_adminbundle_image")
 * @ORM\Entity
 */
class Image extends \Cz\ManagerBundle\Entity\AbstractEntity
{

    /**
     * @ORM\OneToOne(targetEntity="Cz\AdminBundle\Entity\MediaAdmin", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="AcceuilSuite", inversedBy="image")
     * @ORM\JoinColumn(nullable=false)
     */
    private $acceuilsuite;



    /**
     * Set image
     *
     * @param \Cz\AdminBundle\Entity\MediaAdmin $image
     *
     * @return Image
     */
    public function setImage(MediaAdmin $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Cz\AdminBundle\Entity\MediaAdmin
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set acceuilsuite
     *
     * @param \Cz\AdminBundle\Entity\AcceuilSuite $acceuilsuite
     *
     * @return Image
     */
    public function setAcceuilsuite(AcceuilSuite $acceuilsuite)
    {
        $this->acceuilsuite = $acceuilsuite;

        return $this;
    }

    /**
     * Get acceuilsuite
     *
     * @return \Cz\AdminBundle\Entity\AcceuilSuite
     */
    public function getAcceuilsuite()
    {
        return $this->acceuilsuite;
    }


    public function addAcceuilsuite(AcceuilSuite $acceuilsuite)
    {
        $this->acceuilsuite = $acceuilsuite;
    }

}

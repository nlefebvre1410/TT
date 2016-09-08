<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AcceuilSuite
 *
 * @ORM\Table(name="cz_adminbundle_acceuil_suite")
 * @ORM\Entity
 */
class AcceuilSuite extends \Cz\ManagerBundle\Entity\AbstractEntity
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="acceuilsuite", cascade={"persist","remove"})
     */
    private $image;
    /**
     * @var string
     *
     * @ORM\Column(name="nomhotel", type="string", length=255)
     */
    private $nomhotel;

    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \Cz\AdminBundle\Entity\Image $image
     *
     * @return AcceuilSuite
     */
    public function addImage(Image $image)
    {
      $image->addAcceuilsuite($this);
        $this->image->add($image);
    }

    /**
     * Remove image
     *
     * @param \Cz\AdminBundle\Entity\Image $image
     */
    public function removeImage(Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set nomhotel
     *
     * @param string $nomhotel
     *
     * @return ImageTranslation
     */
    public function setNomhotel($nomhotel)
    {
        $this->nomhotel = $nomhotel;

        return $this;
    }

    /**
     * Get nomhotel
     *
     * @return string
     */
    public function getNomhotel()
    {
        return $this->nomhotel;
    }

}

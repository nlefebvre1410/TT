<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ChambreDetails
 *
 * @ORM\Table(name="cz_adminbundle_chambre_details")
 * @ORM\Entity
 */
class ChambreDetails extends \Cz\ManagerBundle\Entity\AbstractEntity
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

    protected $translations;



    /**
     * @ORM\OneToOne(targetEntity="Cz\AdminBundle\Entity\ChambreGenerale", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;
    /**
     * Constructor
     */
    public function __construct()
    {

        $this->translations = new ArrayCollection();
        $this->chambre = $this->getChambre();
    }

    public function setChambre(\Cz\AdminBundle\Entity\ChambreGenerale $chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Cz\AdminBundle\Entity\ChambreGenerale
     */
    public function getChambre()
    {
        return $this->chambre;
    }
}

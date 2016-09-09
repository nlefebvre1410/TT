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
     * Constructor
     */
    public function __construct()
    {

        $this->translations = new ArrayCollection();

    }


}

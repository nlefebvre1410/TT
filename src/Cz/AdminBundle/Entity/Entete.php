<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entete
 *
 * @ORM\Table(name="cz_adminbundle_entete")
 * @ORM\Entity(repositoryClass="Cz\AdminBundle\Repository\EnteteRepository")
 */
class Entete extends \Cz\ManagerBundle\Entity\AbstractEntity
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}


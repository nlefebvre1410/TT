<?php

/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 30/07/2016
 * Time: 13:18
 */
namespace Cz\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractEntity implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id The unique identifier
     *
     * @return AbstractEntity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Return string representation of entity
     *
     * @return string
     */
    public function __toString()
    {
        return "" . $this->getId();
    }

}
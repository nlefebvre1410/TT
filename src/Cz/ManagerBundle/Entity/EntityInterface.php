<?php
namespace Cz\ManagerBundle\Entity;
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 30/07/2016
 * Time: 13:19
 */
interface EntityInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set id
     *
     * @param int $id The unique identifier
     *
     * @return EntityInterface
     */
    public function setId($id);
}
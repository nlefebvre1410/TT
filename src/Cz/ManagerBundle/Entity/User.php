<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 29/07/2016
 * Time: 15:26
 */

namespace Cz\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Cz\ManagerBundle\Repository\UserRepository")
 * @ORM\Table(name="cz_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\ManyToMany(targetEntity="Cz\ManagerBundle\Entity\Group")
     * @ORM\JoinTable(name="cz_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
}
<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 30/07/2016
 * Time: 20:44
 */

namespace Cz\ManagerBundle\Helper\Menu;


class TopMenuItem extends MenuItem
{
    /**
     * @var boolean
     */
    private $appearInSidebar = false;

    /**
     * @param boolean $appearInSidebar
     *
     * @return TopMenuItem
     */
    public function setAppearInSidebar($appearInSidebar)
    {
        $this->appearInSidebar = $appearInSidebar;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAppearInSidebar()
    {
        return $this->appearInSidebar;
    }
}

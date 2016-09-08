<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 30/07/2016
 * Time: 20:51
 */

namespace Cz\ManagerBundle\Helper\Menu;


use Symfony\Component\HttpFoundation\Request;

interface MenuAdaptorInterface
{
    /**
     * In this method you can add children for a specific parent, but also remove and change the already created children
     *
     * @param MenuBuilder   $menu      The MenuBuilder
     * @param MenuItem[]    &$children The current children
     * @param MenuItem|null $parent    The parent Menu item
     * @param Request       $request   The Request
     */
    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null);
}
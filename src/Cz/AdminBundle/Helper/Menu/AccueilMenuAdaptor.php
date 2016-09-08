<?php

namespace Cz\AdminBundle\Helper\Menu;

use Cz\ManagerBundle\Helper\Menu\MenuItem;
use Cz\ManagerBundle\Helper\Menu\MenuAdaptorInterface;
use Cz\ManagerBundle\Helper\Menu\MenuBuilder;
use Cz\ManagerBundle\Helper\Menu\TopMenuItem;
use Symfony\Component\HttpFoundation\Request;

/**
 * MenuAdaptor to add the Modules MenuItem to the top menu
 */
class AccueilMenuAdaptor implements MenuAdaptorInterface
{
    /**
     * In this method you can add children for a specific parent, but also remove and change the already created children
     *
     * @param MenuBuilder $menu      The MenuBuilder
     * @param MenuItem[]  &$children The current children
     * @param MenuItem    $parent    The parent Menu item
     * @param Request     $request   The Request
     */
    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null)
    {
        if (is_null($parent)) {
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('CzAdminBundle_accueil')
                ->setLabel('Acceuil')
                ->setUniqueId('accueil')
                ->setIcon('icon-home2')
                ->setCategory('CONTENU')->setIconCategory('icon-paragraph-left2')
                ->setParent($parent);

            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
            }
            $children[] = $menuItem;
        }
        if (is_null($parent)) {

        } elseif ('CzAdminBundle_accueil' == $parent->getRoute()) {
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('carrousel_edit',array('id'=>1))
                ->setLabel('Carrousel')
                ->setUniqueId('Carrousel')
                ->setCategory('Acceuil')
                ->setParent($parent);

            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;
        }
        if (is_null($parent)) {

        } elseif ('CzAdminBundle_accueil' == $parent->getRoute()) {
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('CzAdminBundle_accueil_en_2_Mots')
                ->setLabel('L\'hôtel en deux mots')
                ->setUniqueId('L\'hôtel en deux mots')
                ->setCategory('Acceuil')
                ->setParent($parent);

            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;
        }
//        if (is_null($parent)) {
//
//        } elseif ('CzAdminBundle_accueil' == $parent->getRoute()) {
//            $menuItem = new TopMenuItem($menu);
//            $menuItem
//                ->setRoute('admin_servicesaccueil_edit',array('id'=>1))
//                ->setLabel('Services')
//                ->setUniqueId('Services')
//                ->setCategory('Acceuil')
//                ->setParent($parent);
//
//            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
//                $menuItem->setActive(true);
//                $parent->setActive(true);
//            }
//            $children[] = $menuItem;
//        }
    }


}

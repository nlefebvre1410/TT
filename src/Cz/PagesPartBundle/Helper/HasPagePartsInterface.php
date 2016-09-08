<?php

namespace  Cz\PagesPartBundle\Helper;

use Cz\PagesPartBundle\PagePartAdmin\PagePartAdminConfiguratorInterface;

/**
 * An interface for something that contains pageparts
 */
interface HasPagePartsInterface
{

    public function getId();

    /**
     * @return PagePartAdminConfiguratorInterface[]
     */
    public function getPagePartAdminConfigurations();

}

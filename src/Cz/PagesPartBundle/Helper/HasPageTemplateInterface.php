<?php

namespace  Cz\PagesPartBundle\Helper;

use Cz\PagesPartBundle\PageTemplate\PageTemplateInterface;

/**
 * HasPageTemplateInterface
 */
interface HasPageTemplateInterface extends HasPagePartsInterface
{

    /**
     * @return PageTemplateInterface[]
     */
    public function getPageTemplates();

}

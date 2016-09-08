<?php

namespace Cz\PagesPartBundle\PageTemplate;

use Cz\PagesPartBundle\Helper\HasPageTemplateInterface;

interface PageTemplateConfigurationReaderInterface
{

    /**
     * @param HasPageTemplateInterface $page
     *
     * @throws \Exception
     * @return PageTemplateInterface[]
     */
    public function getPageTemplates($page);
}

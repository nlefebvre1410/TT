<?php

namespace Cz\PagesPartBundle\PageTemplate;

interface PageTemplateConfigurationParserInterface
{
    /**
     * @param $name
     *
     * @return PageTemplateInterface
     */
    public function parse($name);
}

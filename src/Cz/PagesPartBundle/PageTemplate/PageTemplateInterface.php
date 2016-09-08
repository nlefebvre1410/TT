<?php

namespace Cz\PagesPartBundle\PageTemplate;

interface PageTemplateInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return Row[]
     */
    public function getRows();

    /**
     * @return string
     */
    public function getTemplate();
}
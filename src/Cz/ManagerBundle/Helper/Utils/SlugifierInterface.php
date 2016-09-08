<?php

namespace Cz\ManagerBundle\Helper\Utils;


/**
 * Interface SlugifierInterface
 * @packagenamespace Cz\ManagerBundle\Generator\Helper;
 */
interface SlugifierInterface
{

    /**
     * @param $text
     * @param $default
     * @param $replace
     * @param $delimiter
     * @return mixed
     */
    public function slugify($text, $default = 'n-a', $replace = array("'"), $delimiter = '-');

}

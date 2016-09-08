<?php

namespace Cz\PagesPartBundle\PagePartConfigurationReader;

use Cz\PagesPartBundle\Helper\HasPagePartsInterface;
use Cz\PagesPartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;

interface PagePartConfigurationReaderInterface
{

    /**
     * @param HasPagePartsInterface $page
     *
     * @throws \Exception
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurators(HasPagePartsInterface $page);

    /**
     * @param HasPagePartsInterface $page
     *
     * @throws \Exception
     * @return string[]
     */
    public function getPagePartContexts(HasPagePartsInterface $page);
}

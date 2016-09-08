<?php

namespace Cz\PagesPartBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;
use Cz\PagesPartBundle\Entity\PageTemplateConfiguration;
use Cz\PagesPartBundle\Helper\HasPageTemplateInterface;

/**
 * PageTemplateConfigurationRepository
 */
class PageTemplateConfigurationRepository extends EntityRepository
{

    /**
     * @param HasPageTemplateInterface $page
     *
     * @return PageTemplateConfiguration
     */
    public function findFor(HasPageTemplateInterface $page)
    {
        return $this->findOneBy(array('pageId' => $page->getId(), 'pageEntityName' => ClassLookup::getClass($page)));
    }

}

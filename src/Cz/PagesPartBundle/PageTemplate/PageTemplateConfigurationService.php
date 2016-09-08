<?php

namespace Cz\PagesPartBundle\PageTemplate;

use Cz\PagesPartBundle\Entity\PageTemplateConfiguration;
use Cz\PagesPartBundle\Helper\HasPageTemplateInterface;
use Cz\PagesPartBundle\Repository\PageTemplateConfigurationRepository;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;

class PageTemplateConfigurationService
{
    /**
     * @var PageTemplateConfigurationRepository
     */
    private $repo;

    /**
     * @var PageTemplateConfigurationReaderInterface
     */
    private $reader;


    /**
     * @param PageTemplateConfigurationRepository      $repo
     * @param PageTemplateConfigurationReaderInterface $reader
     */
    public function __construct(PageTemplateConfigurationRepository $repo, PageTemplateConfigurationReaderInterface $reader)
    {
        $this->repo = $repo;
        $this->reader = $reader;
    }

    /**
     * For convenience
     *
     * @param HasPageTemplateInterface $page
     *
     * @return PageTemplateInterface[]
     */
    public function getPageTemplates(HasPageTemplateInterface $page)
    {
        return $this->reader->getPageTemplates($page);
    }

    /**
     * @param HasPageTemplateInterface $page The page
     *
     * @return PageTemplateConfiguration
     */
    public function findOrCreateFor( $page)
    {
        $pageTemplateConfiguration = $this->repo->findFor($page);

        if (null === $pageTemplateConfiguration) {

            $pageTemplates = $this->reader->getPageTemplates($page);
            $names = array_keys($pageTemplates);
            $defaultPageTemplate = $pageTemplates[$names[0]];

            $pageTemplateConfiguration = new PageTemplateConfiguration();
            $pageTemplateConfiguration->setPageId($page->getId());
            $pageTemplateConfiguration->setPageEntityName(ClassLookup::getClass($page));
            $pageTemplateConfiguration->setPageTemplate($defaultPageTemplate->getName());
        }

        return $pageTemplateConfiguration;
    }



}

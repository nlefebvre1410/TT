<?php
namespace Cz\PagesPartBundle\Entity;


use Cz\ManagerBundle\Entity\AbstractEntity;
use Cz\PagesPartBundle\Helper\HasPagePartsInterface;
use Cz\PagesPartBundle\Helper\PagePartInterface;

/**
 * Abstract ORM Pagepart
 */
abstract class AbstractPagePart extends AbstractEntity implements PagePartInterface
{

    /**
     * In most cases, the backend view will not differ from the default one.
     * Also, this implementation guarantees backwards compatibility.
     *
     * @return string
     */
    public function getAdminView()
    {
        return $this->getDefaultView();
    }

    /**
     * Use this method to override the default view for a specific page type.
     * Also, this implementation guarantees backwards compatibility.
     *
     * @return string
     */
    public function getView( $page = null)
    {
        return $this->getDefaultView();
    }
}

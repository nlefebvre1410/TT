<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 09/09/2016
 * Time: 10:30
 */

namespace Cz\ManagerBundle\Event;



use Acme\ContentBundle\Entity\UrlContents;
use Cz\ManagerBundle\Helper\FormWidgets\Tabs\TabPane;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class AdaptFormEvent extends Event
{
    /**
     * @var TabPane
     */
    private $tabPane;

    /**
     * @var Content
     */
    private $urlContents;

    public function __construct(Request $request,TabPane $tabPane = null,UrlContents $urlContents)
    {
        $this->request = $request;
        $this->urlContents=  $urlContents;
        $this->tabPane = $tabPane;

    }

    /**
     * @return TabPane
     */
    public function getTabPane()
    {
        return $this->tabPane;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Content
     */
    public function getUrlContents()
    {
        return $this->urlContents;
    }



}
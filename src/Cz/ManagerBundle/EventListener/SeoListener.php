<?php

namespace Cz\ManagerBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Cz\ManagerBundle\Entity\Seo;
use Cz\ManagerBundle\Form\SeoType;
use Cz\ManagerBundle\Form\SocialType;
use Cz\ManagerBundle\Helper\FormWidgets\FormWidget;
use Cz\ManagerBundle\Helper\FormWidgets\Tabs\Tab;
use Cz\ManagerBundle\Event\AdaptFormEvent;
use Cz\ManagerBundle\Entity\HasNodeInterface;
use Cz\ManagerBundle\Repository\SeoRepository;

/**
 * This will add a seo tab on each page
 */
class SeoListener
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param AdaptFormEvent $event
     */
    public function adaptForm(AdaptFormEvent $event)
    {
            /* @var Seo $seo */

            $seo = $this->em->getRepository('CzManagerBundle:Seo')->findOrCreateFor($event->getUrlContents());
            $seoWidget = new FormWidget();
            $seoWidget->addType('seo', new SeoType(), $seo);
            $event->getTabPane()->addTab(new Tab('SEO', $seoWidget));

//            $socialWidget = new FormWidget();
//            $socialWidget->addType('social', new SocialType(), $seo);
//            $socialWidget->setTemplate('CzManagerBundle:Admin\Social:social.html.twig');
//            $event->getTabPane()->addTab(new Tab('seo.tab.social.title', $socialWidget));
//

    }
}

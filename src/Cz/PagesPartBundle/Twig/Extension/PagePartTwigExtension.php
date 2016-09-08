<?php

namespace Cz\PagesPartBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Cz\PagesPartBundle\Repository\PagePartRefRepository;
use Cz\PagesPartBundle\Helper\PagePartInterface;
use Cz\PagesPartBundle\Helper\HasPagePartsInterface;

/**
 * PagePartTwigExtension
 */
class PagePartTwigExtension extends \Twig_Extension
{

    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('render_pageparts', array($this, 'renderPageParts'), array('needs_environment' => true, 'needs_context' => true,'is_safe' => array('html'))),
            new \Twig_SimpleFunction('getpageparts', array('needs_environment' => true, $this, 'getPageParts')),
        );
    }

    /**
     * @param \Twig_Environment     $env
     * @param array                 $twigContext The twig context
     * @param HasPagePartsInterface $page        The page
     * @param string                $contextName The pagepart context
     * @param array                 $parameters  Some extra parameters
     *
     * @return string
     */
    public function renderPageParts(\Twig_Environment $env, array $twigContext, $page, $contextName = "main", array $parameters = array())
    {

        $template = $env->loadTemplate("CzPagesPartBundle:PagePartTwigExtension:widget.html.twig");
        /* @var $entityRepository PagePartRefRepository */
        $entityRepository = $this->em->getRepository('CzPagesPartBundle:PagePartRef');
//
//

        $pageparts = $entityRepository->getPageParts($page, $contextName);
//        dump(    $pageparts);
//        die();

        $newTwigContext = array_merge($parameters, array(
            'pageparts' => $pageparts
        ));
        $newTwigContext = array_merge($newTwigContext, $twigContext);

        return $template->render($newTwigContext);
    }

    /**
     * @param HasPagePartsInterface $page    The page
     * @param string                $context The pagepart context
     *
     * @return PagePartInterface[]
     */
    public function getPageParts(HasPagePartsInterface $page, $context = "main")
    {
        /**@var $entityRepository PagePartRefRepository */
        $entityRepository = $this->em->getRepository('CzPagePartBundle:PagePartRef');
        $pageparts = $entityRepository->getPageParts($page, $context);

        return $pageparts;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pageparts_twig_extension';
    }

}

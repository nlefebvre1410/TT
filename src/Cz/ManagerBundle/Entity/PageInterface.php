<?php

namespace Cz\ManagerBundle\Entity;

use Cz\ManagerBundle\Entity\HasNodeInterface;
use Cz\ManagerBundle\Helper\RenderContext;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * The Page Interface
 */
interface PageInterface extends HasNodeInterface
{

    /**
     * @param ContainerInterface $container The Container
     * @param Request            $request   The Request
     * @param RenderContext      $context   The Render context
     *
     * @return void|RedirectResponse
     */
    public function service(ContainerInterface $container, Request $request, RenderContext $context);
}

<?php

namespace Acme\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return new RedirectResponse($this->generateUrl('_slug', array('url'=>'', '_locale'=>$this->container->getParameter('locale'))));

    }
}

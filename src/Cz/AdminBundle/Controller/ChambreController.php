<?php

namespace Cz\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ChambreController extends Controller
{
    /**
     * @Route("/",name="CzAdminBundle_chambre")
     */
    public function indexAction()
    {
        return array();
    }

}

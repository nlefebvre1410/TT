<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 26/08/2016
 * Time: 21:27
 */

namespace Cz\ManagerBundle\Controller;

use Cz\ManagerBundle\Helper\RenderContext;
use Acme\ContentBundle\Entity\Content;
use Acme\ContentBundle\Form\ContentType;
use Cz\ManagerBundle\Entity\HasNodeInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SlugController extends Controller
{
    private function dumps($e)
    {
        dump($e);
        die();

    }
    /**
    /**
     * @param Request $request
     * @param null $url
     * @param bool $preview
     * @return array
     */
    public function slugAction(Request $request, $url = null, $preview = false)
    {
        /* @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $nodeTranslation = $request->attributes->get('_nodeTranslation');

        $entity = $this->getPageEntity(
            $request,
            $preview,
            $em,
            $nodeTranslation
        );

        if (!$nodeTranslation) {
            throw $this->createNotFoundException('No page found for slug ' . $url);
        }

        $renderContext = new RenderContext(
            array(
                'nodetranslation' => $nodeTranslation,
                'slug'            => $url,
                'page'            => $entity,
//                'resource'        => $entity,
//                'nodemenu'        => $nodeMenu,
            )
        );

        if (method_exists($entity, 'getDefaultView')) {
            /** @noinspection PhpUndefinedMethodInspection */

            $renderContext->setView($entity->getDefaultView());

        }
        $view = $renderContext->getView();
//        $this->dumps($entity->getDefaultView());

        if (empty($view)) {
            throw $this->createNotFoundException('No page found for view ' . $url);
        }

        $template = new Template(array());
        $template->setTemplate($view);

        $request->attributes->set('_template', $template);


        return $renderContext->getArrayCopy();

    }


    /**
     * @param Request $request
     * @param $preview
     * @param EntityManagerInterface $em
     * @param Content $content
     * @return HasNodeInterface
     */
    private function getPageEntity(Request $request, $preview, EntityManagerInterface $em, $content)
    {

        /* @var HasNodeInterface $entity */
        $entity = null;

        if (is_null($entity)) {
            $entity = $content->getRef($em);

            return $entity;
        }

        return $entity;
    }

}
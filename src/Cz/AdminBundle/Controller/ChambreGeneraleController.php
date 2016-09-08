<?php

namespace Cz\AdminBundle\Controller;

use Cz\AdminBundle\Event\UrlEvent;
use Cz\AdminBundle\Event\CzEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cz\AdminBundle\Entity\ChambreGenerale;
use Cz\AdminBundle\Form\ChambreGeneraleType;
use A2lix\I18nDoctrineBundle\Annotation\I18nDoctrine as A2lixI18nDoctrine;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;



/**
 * ChambreGenerale controller.
 *
 * @Route("/chambregenerale")
 */
class ChambreGeneraleController extends Controller
{
    /**
     * Lists all ChambreGenerale entities.
     *
     * @Route("/", name="admin_chambregenerale_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $chambreGenerales = $em->getRepository('CzAdminBundle:ChambreGenerale')->findAll();

        return $this->render('chambregenerale/index.html.twig', array(
            'chambreGenerales' => $chambreGenerales,
        ));
    }

    /**
     * Creates a new ChambreGenerale entity.
     *
     * @Route("/new", name="admin_chambregenerale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $chambreGenerale = new ChambreGenerale();
        $form = $this->createForm('Cz\AdminBundle\Form\ChambreGeneraleType', $chambreGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambreGenerale);
            $em->flush();

            return $this->redirectToRoute('admin_chambregenerale_show', array('id' => $chambreGenerale->getId()));
        }

        return $this->render('chambregenerale/new.html.twig', array(
            'chambreGenerale' => $chambreGenerale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ChambreGenerale entity.
     *
     * @Route("/{slug}", name="admin_chambregenerale_show")
     * @Method("GET")
     */
    public function showAction(Request $request,$slug)
    {
//        $router = $this->get("router");
//        $route = $router->match($this->getRequest()->getPathInfo());
//        var_dump($route['_route']);$em = $this->getDoctrine()->getManager();
//        $route = new Route('/{slug}', array('controller' => 'show'));
//        $routes = new RouteCollection();
//        $routes->add('route_name', $route);
//
//        $context = new RequestContext('/');
//
//        $matcher = new UrlMatcher($routes, $context);
//
//        $parameters = $matcher->match('/{slug}');
//
//        var_dump($parameters);
//        die();
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('CzAdminBundle:ChambreGeneraleTranslation')->findOneBySlug($slug);

        if (!$page) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('CzAdminBundle:pages:layout/pages.html.twig', array('page' => $page));
    }

    /**
     * Displays a form to edit an existing ChambreGenerale entity.
     * @A2lixI18nDoctrine
     * @Route("/{id}/edit", name="admin_chambregenerale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ChambreGenerale $chambreGenerale)
    {
        $deleteForm = $this->createDeleteForm($chambreGenerale);
        $editForm = $this->createForm('Cz\AdminBundle\Form\ChambreGeneraleType', $chambreGenerale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $event = new UrlEvent( $chambreGenerale);

            $this->get('debug.event_dispatcher')->dispatch(
                CzEvents::ADD_URL, $event
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambreGenerale);
            $em->flush();

            return $this->redirectToRoute('admin_chambregenerale_edit', array('id' => $chambreGenerale->getId()));
        }

        return $this->render('chambregenerale/edit.html.twig', array(
            'chambreGenerale' => $chambreGenerale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ChambreGenerale entity.
     *
     * @Route("/{id}", name="admin_chambregenerale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ChambreGenerale $chambreGenerale)
    {
        $form = $this->createDeleteForm($chambreGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chambreGenerale);
            $em->flush();
        }

        return $this->redirectToRoute('admin_chambregenerale_index');
    }

    /**
     * Creates a form to delete a ChambreGenerale entity.
     *
     * @param ChambreGenerale $chambreGenerale The ChambreGenerale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChambreGenerale $chambreGenerale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_chambregenerale_delete', array('id' => $chambreGenerale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Deletes a ChambreGenerale entity.
     *
     * @Route("/{slug}", name="admin_chambregenerale_slug")
     *
     */
    public function pageAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('CzAdminBundle:ChambreGenerale')->findOneBySlug($slug);

        if (!$page) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('CzAdminBundle:pages:layout/pages.html.twig', array('page' => $page));
    }
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('CzAdminBundle:ChambreGenerale')->findAll();

        return $this->render('CzAdminBundle:pages:modulesUsed/menu.html.twig', array('pages' => $pages));
    }
}

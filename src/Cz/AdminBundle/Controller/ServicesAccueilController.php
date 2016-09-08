<?php

namespace Cz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cz\AdminBundle\Entity\ServicesAccueil;
use Cz\AdminBundle\Form\ServicesAccueilType;

/**
 * ServicesAccueil controller.
 *
 * @Route("/servicesaccueil")
 */
class ServicesAccueilController extends Controller
{
    /**
     * Lists all ServicesAccueil entities.
     *
     * @Route("/", name="admin_servicesaccueil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicesAccueils = $em->getRepository('CzAdminBundle:ServicesAccueil')->findAll();

        return $this->render('servicesaccueil/index.html.twig', array(
            'servicesAccueils' => $servicesAccueils,
        ));
    }

    /**
     * Creates a new ServicesAccueil entity.
     *
     * @Route("/new", name="admin_servicesaccueil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servicesAccueil = new ServicesAccueil();
        $form = $this->createForm('Cz\AdminBundle\Form\ServicesAccueilType', $servicesAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicesAccueil);
            $em->flush();

            return $this->redirectToRoute('admin_servicesaccueil_show', array('id' => $servicesAccueil->getId()));
        }

        return $this->render('servicesaccueil/new.html.twig', array(
            'servicesAccueil' => $servicesAccueil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ServicesAccueil entity.
     *
     * @Route("/{id}", name="admin_servicesaccueil_show")
     * @Method("GET")
     */
    public function showAction(ServicesAccueil $servicesAccueil)
    {
        $deleteForm = $this->createDeleteForm($servicesAccueil);

        return $this->render('servicesaccueil/show.html.twig', array(
            'servicesAccueil' => $servicesAccueil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ServicesAccueil entity.
     *
     * @Route("/{id}/edit", name="admin_servicesaccueil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ServicesAccueil $servicesAccueil)
    {
        $deleteForm = $this->createDeleteForm($servicesAccueil);
        $editForm = $this->createForm('Cz\AdminBundle\Form\ServicesAccueilType', $servicesAccueil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicesAccueil);
            $em->flush();

            return $this->redirectToRoute('admin_servicesaccueil_edit', array('id' => $servicesAccueil->getId()));
        }

        return $this->render('servicesaccueil/edit.html.twig', array(
            'servicesAccueil' => $servicesAccueil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ServicesAccueil entity.
     *
     * @Route("/{id}", name="admin_servicesaccueil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServicesAccueil $servicesAccueil)
    {
        $form = $this->createDeleteForm($servicesAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicesAccueil);
            $em->flush();
        }

        return $this->redirectToRoute('admin_servicesaccueil_index');
    }

    /**
     * Creates a form to delete a ServicesAccueil entity.
     *
     * @param ServicesAccueil $servicesAccueil The ServicesAccueil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServicesAccueil $servicesAccueil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_servicesaccueil_delete', array('id' => $servicesAccueil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace Cz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cz\AdminBundle\Entity\ChambreDetails;
use Cz\AdminBundle\Form\ChambreDetailsType;

/**
 * ChambreDetails controller.
 *
 * @Route("/chambredetails")
 */
class ChambreDetailsController extends Controller
{
    /**
     * Lists all ChambreDetails entities.
     *
     * @Route("/", name="chambredetails_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chambreDetails = $em->getRepository('CzAdminBundle:ChambreDetails')->findAll();

        return $this->render('chambredetails/index.html.twig', array(
            'chambreDetails' => $chambreDetails,
        ));
    }

    /**
     * Creates a new ChambreDetails entity.
     *
     * @Route("/new", name="chambredetails_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $page = $em->getRepository('CzAdminBundle:ChambreGenerale')->find(1);
//
//        var_dump(    $page->getTranslationEntityClass());
//        die();
        $chambreDetail = new ChambreDetails();
        $form = $this->createForm('Cz\AdminBundle\Form\ChambreDetailsType', $chambreDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambreDetail);
            $em->flush();

            return $this->redirectToRoute('chambredetails_show', array('id' => $chambreDetail->getId()));
        }

        return $this->render('chambredetails/new.html.twig', array(
            'chambreDetail' => $chambreDetail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ChambreDetails entity.
     *
     * @Route("/{id}", name="chambredetails_show")
     * @Method("GET")
     */
    public function showAction(ChambreDetails $chambreDetail)
    {
        $deleteForm = $this->createDeleteForm($chambreDetail);

        return $this->render('chambredetails/show.html.twig', array(
            'chambreDetail' => $chambreDetail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ChambreDetails entity.
     *
     * @Route("/{id}/edit", name="chambredetails_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ChambreDetails $chambreDetail)
    {
        $deleteForm = $this->createDeleteForm($chambreDetail);
        $editForm = $this->createForm('Cz\AdminBundle\Form\ChambreDetailsType', $chambreDetail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambreDetail);
            $em->flush();

            return $this->redirectToRoute('chambredetails_edit', array('id' => $chambreDetail->getId()));
        }

        return $this->render('chambredetails/edit.html.twig', array(
            'chambreDetail' => $chambreDetail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ChambreDetails entity.
     *
     * @Route("/{id}", name="chambredetails_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ChambreDetails $chambreDetail)
    {
        $form = $this->createDeleteForm($chambreDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chambreDetail);
            $em->flush();
        }

        return $this->redirectToRoute('chambredetails_index');
    }

    /**
     * Creates a form to delete a ChambreDetails entity.
     *
     * @param ChambreDetails $chambreDetail The ChambreDetails entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChambreDetails $chambreDetail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chambredetails_delete', array('id' => $chambreDetail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Deletes a ChambreGenerale entity.
     *
     * @Route("/{slug}", name="admin_chambregenerale_details_slug")
     *
     */
    public function pageAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('CzAdminBundle:ChambreDetails')->findOneBySlug($slug);

        if (!$page) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('CzAdminBundle:pages:layout/pages.html.twig', array('page' => $page));
    }
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('CzAdminBundle:ChambreDetails')->findAll();

        return $this->render('CzAdminBundle:pages:modulesUsed/menu2.html.twig', array('pages' => $pages));
    }
}

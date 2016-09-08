<?php

namespace Cz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cz\AdminBundle\Entity\Carrousel;
use Cz\AdminBundle\Form\CarrouselType;
use A2lix\I18nDoctrineBundle\Annotation\I18nDoctrine as A2lixI18nDoctrine;

/**
 * Carrousel controller.
 *
 * @Route("/carrousels")
 */
class CarrouselController extends Controller
{
    /**
     * Lists all Carrousel entities.
     *
     * @Route("/", name="carrousel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carrousels = $em->getRepository('CzAdminBundle:Carrousel')->findAll();

        return $this->render('carrousel/index.html.twig', array(
            'carrousels' => $carrousels,
        ));
    }

    /**
     * Creates a new Carrousel entity.
     *
     * @Route("/new", name="carrousel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $carrousel = new Carrousel();
        $form = $this->createForm('Cz\AdminBundle\Form\CarrouselType', $carrousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrousel);
            $em->flush();

            return $this->redirectToRoute('carrousel_show', array('id' => $carrousel->getId()));
        }

        return $this->render('carrousel/new.html.twig', array(
            'carrousel' => $carrousel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carrousel entity.
     *
     * @Route("/{id}", name="carrousel_show")
     * @Method("GET")
     */
    public function showAction(Carrousel $carrousel)
    {
        $deleteForm = $this->createDeleteForm($carrousel);

        return $this->render('carrousel/show.html.twig', array(
            'carrousel' => $carrousel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Carrousel entity.
     * @A2lixI18nDoctrine
     * @Route("/{id}/edit", name="carrousel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Carrousel $carrousel)
    {
        $local = $request->getLocale();
        $deleteForm = $this->createDeleteForm($carrousel);
        $editForm = $this->createForm('Cz\AdminBundle\Form\CarrouselType', $carrousel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrousel);
            $em->flush();

            return $this->redirectToRoute('carrousel_edit', array('id' => $carrousel->getId()));
        }

        return $this->render('carrousel/edit.html.twig', array(
            'locale' => $local,
            'carrousel' => $carrousel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carrousel entity.
     *
     * @Route("/{id}", name="carrousel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Carrousel $carrousel)
    {
        $form = $this->createDeleteForm($carrousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carrousel);
            $em->flush();
        }

        return $this->redirectToRoute('carrousel_index');
    }

    /**
     * Creates a form to delete a Carrousel entity.
     *
     * @param Carrousel $carrousel The Carrousel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carrousel $carrousel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carrousel_delete', array('id' => $carrousel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Displays a form to edit an existing Carrousel entity.
     *
     * @Route("/{id}/editajax", name="carrousel_edit_ajax"  , options = { "expose" = true })
     * @Method({"GET"})
     */
    public function editajaxAction(Request $request, Carrousel $carrousel)
    {
//        if ($request->isXmlHttpRequest()) {

            $images = array();
            foreach ($carrousel->getSlides() as $t) {

                $images[] = $t->getImage()->getPath();
//                $images[] = array('img' => $t->getImage()->getPath());
//                $images[] = array('id' => $t->getId());
            }


            $response = new JsonResponse();

            return $response->setData(array('images' => $images));
//            }
//        else {
//            throw new \Exception('Erreur');
//                }
    }
}

<?php

namespace Acme\ContentBundle\Controller;

use Acme\ContentBundle\Entity\UrlContents;
use Acme\ContentBundle\Form\UrlContentsType;
use Cz\AdminBundle\Entity\Entete;
use Cz\AdminBundle\Form\EnteteType;
use Cz\ManagerBundle\FlashMessages\FlashTypes;
use Cz\ManagerBundle\Helper\FormWidgets\FormWidget;
use Cz\ManagerBundle\Helper\FormWidgets\Tabs\Tab;
use Cz\ManagerBundle\Helper\FormWidgets\Tabs\TabPane;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Content controller.
 *
 * @Route("/admin/content")
 */
class ContentController extends Controller
{
    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * @var string $locale
     */
    protected $locale;

    /**
     * @var BaseUser $user
     */
    protected $user;

    /**
     * init
     *
     * @param Request $request
     */
    protected function init(Request $request)
    {
        $this->em                   = $this->getDoctrine()->getManager();
        $this->locale               = $request->getLocale();
        $this->user                 = $this->getUser();

    }
    /**
     * Lists all Content entities.
     *
     * @Route("/", name="content_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contents = $em->getRepository('AcmeContentBundle:Content')->findAll();

        return $this->render('AcmeContentBundle:Content:index.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * Creates a new Content entity.
     *
     * @Route("/new", name="content_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request )
    {
        $this->init($request);

        $parentNode = $this->em->getRepository('AcmeContentBundle:Content')->find(1);
        $e =    count(  $parentNode);

        $content = new UrlContents();

        $form = $this->createForm('Acme\ContentBundle\Form\UrlContentsType', $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($content);
            $em->flush();

            return $this->redirectToRoute('content_show', array('id' => $content->getId()));
        }

        return $this->render('AcmeContentBundle:Content:new.html.twig', array(
            'content' => $content,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Content entity.
     *
     * @Route("/{id}", name="content_show")
     * @Method("GET")
     */
    public function showAction(Content $content)
    {
        $deleteForm = $this->createDeleteForm($content);

        return $this->render('content/show.html.twig', array(
            'content' => $content,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Content entity.
     *
     * @Route("/{id}/edit", name="content_edit")
     *
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request)
    {
        $this->init($request);

        $em = $this->getDoctrine()->getManager();
        $urlcontent = $em->getRepository('AcmeContentBundle:UrlContents')->find($id);

        $tabPane = new TabPane(
            'todo',
            $request,
            $this->container->get('form.factory')
        );


        $propertiesWidget = new FormWidget();
        $enteteAdminType = new EnteteType();
        $entete = new Entete();
        if (!is_object($enteteAdminType) && is_string($enteteAdminType)) {
            $enteteAdminType = $this->container->get($enteteAdminType);
        }

        $propertiesWidget->addType('content', $enteteAdminType,   $entete);
        $tabPane->addTab(new Tab('cz_manager.tab.properties.title', $propertiesWidget));

        if (!$urlcontent) {
            throw $this->createNotFoundException('No task found for id '.$id);
        }

        $originalTags = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($urlcontent->getContent() as $content) {
            $originalTags->add($content);
        }

        $editForm = $this->createForm(new UrlContentsType(), $urlcontent);
        $tabPane->buildForm();


        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            // remove the relationship between the tag and the Task
            foreach ($originalTags as $content) {
                if (false === $urlcontent->getContent()->contains($content)) {
                    // remove the Task from the Tag
                    $content->getUrlContents()->removeElement($urlcontent);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $content->setUrlContent(null);

                    $em->persist($content);

                    // if you wanted to delete the Tag entirely, you can also do that
                    // $em->remove($content);
                }
            }

            $em->persist($urlcontent);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                FlashTypes::SUCCESS,
                $this->get('translator')->trans('cz_manager.edit.flash.success')
            );

            // redirect back to some edit page
            return $this->redirectToRoute('content_edit', array('id' => $id));
        }
//        dump($tabPane);
////        dump($queuedNodeTranslationAction);
//        die();
        return $this->render('AcmeContentBundle:Content:edit.html.twig', array(
            'content' => $urlcontent,
            'tabPane'                     => $tabPane,
            'edit_form' =>  $editForm->createView(),

        ));
    }

    /**
     * Deletes a Content entity.
     *
     * @Route("/{id}", name="content_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Content $content)
    {
        $form = $this->createDeleteForm($content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($content);
            $em->flush();
        }

        return $this->redirectToRoute('content_index');
    }

    /**
     * Creates a form to delete a Content entity.
     *
     * @param Content $content The Content entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Content $content)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('content_delete', array('id' => $content->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



}

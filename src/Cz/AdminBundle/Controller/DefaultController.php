<?php

namespace Cz\AdminBundle\Controller;

use Cz\AdminBundle\Entity\Carrousel;
use Cz\AdminBundle\Entity\Namec;
use Cz\AdminBundle\Entity\Node;
use Cz\AdminBundle\Entity\Pages;
use Cz\AdminBundle\Entity\PagesTranslation;
use Cz\AdminBundle\Entity\Person;
use Cz\AdminBundle\Entity\Post;
use Cz\AdminBundle\Entity\Product;
use Cz\AdminBundle\Entity\Property;
use Cz\AdminBundle\Entity\Tag;
use Cz\AdminBundle\Form\NamecType;
use Cz\AdminBundle\Form\CarrouselType;
use Cz\AdminBundle\Form\Handler\CzHandler;
use Cz\AdminBundle\Form\NodeAdminType;
use Cz\AdminBundle\Form\PagesTranslationType;
use Cz\AdminBundle\Form\PostType;
use Cz\AdminBundle\Form\ProductType;
use Cz\AdminBundle\Form\PropertyType;
use DateTime;

use InvalidArgumentException;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Model\MutableAclProviderInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityRetrievalStrategyInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Model\EntryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class DefaultController extends Controller
{
    private function dumps($pe){

       dump($pe);
           die();
    }
    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * @var string $locale
     */
    protected $locale;

    /**
     * @var AuthorizationCheckerInterface $authorizationChecker
     */
    protected $authorizationChecker;

    /**
     * @var BaseUser $user
     */
    protected $user;

    /**
     * @var AclHelper $aclHelper
     */
    protected $aclHelper;


    /**
     * init
     *
     * @param Request $request
     */
    protected function init(Request $request)
    {
        $this->em                   = $this->getDoctrine()->getManager();
        $this->locale               = $request->getLocale();
        $this->authorizationChecker = $this->get('security.authorization_checker');
        $this->user                 = $this->getUser();
        $this->aclHelper            = $this->get('kunstmaan_admin.acl.helper');
    }
    /**
     * @Route("/", name="CzAdminBundle_homepage" )
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * Creates a form to edit a PagesCarrousel entity.
     *
     * @param PagesCarrousel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Carrousel $entity)
    {
        $form = $this->createForm(new CarrouselType(), $entity, array(
            'action' => $this->generateUrl('carrousel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PagesCarrousel entity.
     *
     * @Route("/{id}", name="carrousel_update")
     * @Method("PUT")
     * @Template("CzAdminBundle:Carrousel:carrouselview.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CzAdminBundle:Carrousel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrousel entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('CzAdminBundle_carrouseltestview', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * @Route("/carrousel/list" , name="CzAdminBundle_carrousel_list")
     * @Template("CzAdminBundle:Carrousel:carrousel_list.html.twig")
     */
    public function carrouselListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('CzAdminBundle:Carrousel')->getLang($request->getLocale());
        return array('list'=>$list);
    }

    /**
     * @Route("/carrousel" , name="CzAdminBundle_carrousel")
     * @Template("CzAdminBundle:Carrousel:carrousel.html.twig")
     */
    public function carrouselAction(Request $request)
    {
        $form = $this->get('cz_handler_carrousel');
        if($form->process()){
            return $this->redirect($this->generateUrl("CzAdminBundle_homepage"));
        }
        return  array('form'=> $form->createView());
    }


    /**
     * @Route("/carrouseltestview/{id}" , name="CzAdminBundle_carrouseltestview")
     * @Template("CzAdminBundle:Carrousel:carrouselview.html.twig")
     */
    public function carrouseltestviewAction($id)
    {
        $carrousel = $this->getDoctrine()
            ->getRepository('CzAdminBundle:Carrousel')
            ->find($id);
        $editForm = $this->createEditForm($carrousel);

        return array('carrousel' => $carrousel,'editForm'=> $editForm);
    }



    /**
     * @Route("/carrouseltest" , name="CzAdminBundle_carrouseltest")
     * @Template("CzAdminBundle:Carrousel:carrousel.html.twig")
     */
    public function carrouseltestAction(Request $request)
    {

        $carrousel = new Carrousel();
        $form = $this->createForm(CarrouselType::class, $carrousel);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $carrousel = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrousel);
            $em->flush();

            return $this->redirectToRoute('CzAdminBundle_carrouseltestview', array('id' => $carrousel->getId()));
        }

        return  array('form'=> $form->createView());
    }




    /**
     * @Route("/personnalisation", name="CzAdminBundle_perso")
     * @Template("CzAdminBundle:Personnalisation:index.html.twig")
     */
    public function persoAction(Request $request)
    {

        return array(

        );

    }

    /**
     * @Route("/services", name="CzAdminBundle_services")
     * @Template()
     */
    public function servicesAction()
    {
        return $this->render("CzAdminBundle:Services:index.html.twig");
    }
    /**
     * @Route("/stats" , name="CzAdminBundle_stats")
     * @Template()
     */
    public function statsAction(Request $request)
    {

        $form = $this->get('cz_handler_carrousel');
        if($form->process()){
            return $this->redirect($this->generateUrl("CzAdminBundle_homepage"));
        }

        return $this->render("CzAdminBundle:Stats:stats.html.twig", array( 'form'=> $form->createView()));
    }




    /**
     * @Route("/ajax/piwik" , name="CzAdminBundle_stats_piwik")
     */
    public function piwikAction(Request $request)
    {
        $visit = $request->get('visit', 'all');
        $range = $request->get('range', 'hour');

        echo $this->get('cz_manager.piwik')->getVisitsByRange($visit, $range);
        exit;
    }


    /**
     * Creates a new Demo entity.
     *
     * @Route("/test", name="demo_create")
     * @Method("POST")
     *
     */
    public function ajaxFormAction(Request $request) {
//        if ($request->isXmlHttpRequest()) {

        //création du formulaire
        $myFormObject = new PagesTranslation();

        $myEntityForm   = $this->createForm(new PagesTranslationType(), $myFormObject);
        $myEntityForm->handleRequest($request);

        if (   $myEntityForm-->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist( $myEntityForm );
            $em->flush();

            //envoi des données JSON en front
            $response = new JsonResponse();
            $response->setStatusCode(200);
            //ajout de données éventuelles
            $response->setData(array(
                'successMessage' => "Votre message a bien été envoyé"));
            return $response;
        } else {
            //form non valide
            //envoi des données d'erreurs JSON en front
            $response = new JsonResponse();
            $response->setStatusCode(412);
            $response->setData(array(
                'formErrors' => $this->renderView('CzAdminBundle:Carrousel:carrousel.test.html.twig',
                    array('form' => $myEntityForm->createView() )
                ),

            ));
            return $response;
        }
    }

}

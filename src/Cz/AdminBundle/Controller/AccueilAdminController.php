<?php

namespace Cz\AdminBundle\Controller;

use Cz\AdminBundle\Entity\AcceuilSuite;
use Cz\AdminBundle\Entity\AcEn2Mots;
use Cz\AdminBundle\Entity\MediaAdmin;
use Cz\AdminBundle\Entity\ServicesAccueil;
use Cz\AdminBundle\Form\AcceuilSuiteType;
use Cz\AdminBundle\Form\AcEn2MotsType;
use Cz\AdminBundle\Form\ServicesAccueilType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class AccueilAdminController extends Controller
{
    /**
     * @Route("/", name="CzAdminBundle_accueil")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/admin/endeuxmots", name="CzAdminBundle_accueil_en_2_Mots")
     * @Template("CzAdminBundle:Accueil:suite.html.twig")
     */
    public function en2MotsAction(Request $request)
    {

        $entity = new  AcceuilSuite();

        $form = $this->createForm(new AcceuilSuiteType(),$entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity=  $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            return $this->redirectToRoute('CzAdminBundle_homepage', array('id'=> $entity->getId()));
        }

        return  array('form'=> $form->createView());
    }
//    /**
//         * @Route("/admin/{id}/acceuilservices", name="CzAdminBundle_accueil_services")
//     * @Template("CzAdminBundle:Accueil:services.html.twig")
//     */
//    public function accueilServicesAction(Request $request,$id)
//    {
//        $e =$request->get('id');
//
//            if(  $e === '1')
//            {
//                 $entity  =  new ServicesAccueil();
//                $form = $this->createForm(new ServicesAccueilType(),$entity);
//
//                $form->handleRequest($request);
//
//                if ( $form->isValid()) {
//                    //do your stuff ...
//                    $entity =  $form->getData();
//                    $em = $this->getDoctrine()->getManager();
//                    $em->persist($entity);
//                    $em->flush();
//
//                    //envoi des données JSON en front
//                    $response = new JsonResponse();
//                    $response->setStatusCode(200);
//                    //ajout de données éventuelles
//                    $response->setData(array(
//                        'id' => $entity->getId(),
//                        'successMessage' => "Votre message a bien été envoyé"));
//                    return $response;
//                }
////                else {
////                    //form non valide
////                    //envoi des données d'erreurs JSON en front
////                    $response = new JsonResponse();
////                    $response->setStatusCode(412);
////                    $response->setData(array(
////                        'myMessage' => 'error',
////                            array('form' =>  $form->createView() )
////                        )
////
////                    );
////                    return $response;
////                }
//               return array('form' =>  $form->createView() );
//            }else{
//
//                    throw $this->createNotFoundException('Vous ne devez pas touche à se chiffre.');
//
//            }
//
//    }


}

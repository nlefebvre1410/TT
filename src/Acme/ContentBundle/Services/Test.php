<?php
namespace Acme\ContentBundle\Services;
use Doctrine\ORM\EntityManager;

class Test
{

    private $em = null;

    public function __construct(EntityManager $em) { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
        $this->repository = $em->getRepository('AcmeContentBundle:Content');
    }

    public function findOneByGuids($guid)
    {

        return $this->repository->findOneBySlug($guid);
    }

}
<?php
namespace Cz\ManagerBundle\Manager;

use Doctrine\ORM\EntityManager;
use Cz\ManagerBundle\Manager\BaseManager;
use Symfony\Component\Validator\Constraints\Valid;

class CzManager extends BaseManager
{
    protected $em;
    protected $bundle;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;


    }

    public function loadDesk($deskId) {
        return $this->getRepository()
            ->findOneBy(array('id' => $deskId));
    }

    /**
     * Save Adresse entity
     *
     * @param Adresse $desk
     */
    public function flush($adresse)
    {
        $this->persistAndFlush($adresse);
    }

    public function getPreviousDesk($deskId) {
        return $this->getRepository()
            ->getAdjacentDesk($deskId, false)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

    public function getNextDesk($deskId) {
        return $this->getRepository()
            ->getAdjacentDesk($deskId, true)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

    public function isAuthorized(Adresse $desk, $memberId)
    {
        return ($desk->getMember()->getId() == $memberId) ?
            true:
            false;
    }

    public function getPreviousAndNextDesk($desk)
    {
        return array(
            'prev' => $this->getPreviousDesk($desk->getId()),
            'desk' => $desk,
            'next' => $this->getNextDesk($desk->getId()),
            'voted' => false
        );
    }
    public function getList($page=1, $maxperpage=10)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('article')
            ->from('SimaDemoBundle:Article','article')
        ;

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
    public function getBundle($bundle)
    {

        return $this->bundle = $bundle;
    }
    public function getRepository($entity)
    {

        return $this->em->getRepository($entity);
    }

}
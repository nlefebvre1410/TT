<?php

namespace Cz\ManagerBundle\Repository;


use Doctrine\ORM\EntityRepository;

use Cz\ManagerBundle\Entity\Seo;
use Cz\ManagerBundle\Entity\AbstractEntity;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;

/**
 * Repository for Seo
 */
class SeoRepository extends EntityRepository
{

    /**
     * Find the seo information for the given entity
     *
     * @param AbstractEntity $entity
     *
     * @return Seo
     */
    public function findFor(AbstractEntity $entity)
    {

        return $this->findOneBy(array('refId' => $entity->getId(), 'refEntityName' => ClassLookup::getClass($entity)));
    }

    /**
     * @param AbstractEntity $entity
     *
     * @return Seo
     */
    public function findOrCreateFor(AbstractEntity $entity)
    {

        $seo = $this->findFor($entity);

        if (is_null($seo)) {
            $seo = new Seo();

        }

        return $seo;
    }

}

<?php

namespace Cz\ManagerBundle\Entity;

use Acme\ContentBundle\Entity\Content;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Cz\ManagerBundle\Entity\AbstractEntity;
use Cz\ManagerBundle\Form\SeoType;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;

/**
 * Seo metadata for entities
 *
 * @ORM\Entity(repositoryClass="Cz\ManagerBundle\Repository\SeoRepository")
 * @ORM\Table(name="cz_manager_seo", indexes={@ORM\Index(name="idx_seo_lookup", columns={"ref_id", "ref_entity_name"})})
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Seo extends AbstractEntity
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
    /**
     * @var int
     *
     * @ORM\Column(type="bigint", name="ref_id")
     */
    protected $refId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="ref_entity_name")
     */
    protected $refEntityName;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {

        $this->translations = new ArrayCollection();
    }
//    public function setRef(SeoTranslation $seoTranslation)
//    {
//        $seoTranslation->setRef($this);
//    }

    /**
     * Get refId
     *
     * @return int
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Set refId
     *
     * @param int $refId
     *
     * @return Seo
     */
    protected function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Set reference entity name
     *
     * @param string $refEntityName
     *
     * @return Seo
     */
    protected function setRefEntityName($refEntityName)
    {
        $this->refEntityName = $refEntityName;

        return $this;
    }

    /**
     * Get reference entity name
     *
     * @return string
     */
    public function getRefEntityName()
    {
        return $this->refEntityName;
    }

    /**
     * @param AbstractEntity $entity
     *
     * @return Seo
     */
    public function setRef(AbstractEntity $entity)
    {
        $this->setRefId($entity->getId());
        $this->setRefEntityName(ClassLookup::getClass($entity));

        return $this;
    }

    /**
     * @param EntityManager $em
     *
     * @return AbstractEntity
     */
    public function getRef(EntityManager $em)
    {
        return $em->getRepository($this->getRefEntityName())->find($this->getRefId());
    }

    /**
     * @return SeoType
     */
    public function getDefaultAdminType()
    {
        return new SeoType();
    }
}

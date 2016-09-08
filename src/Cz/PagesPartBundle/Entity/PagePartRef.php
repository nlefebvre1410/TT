<?php

namespace Cz\PagesPartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
/**
 * PagePartRef
 *  @ORM\Entity(repositoryClass="Cz\PagesPartBundle\Repository\PagePartRefRepository")
 *  @ORM\Table(name="cz_page_part_refs", indexes={@ORM\Index(name="idx_page_part_search", columns={"page_Id", "pageEntityname", "context"})})
 *  @ORM\HasLifecycleCallbacks()
 */
class PagePartRef
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="bigint", name="page_id")
     */
    protected $pageId;

    /**
     * @ORM\Column(type="string", name="pageEntityname"))
     */
    protected $pageEntityname;

    /**
     * @ORM\Column(type="string")
     */
    protected $context;

    /**
     * @ORM\Column(type="integer")
     */
    protected $sequencenumber;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $pagePartId;

    /**
     * @ORM\Column(type="string")
     */
    protected $pagePartEntityName;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pageId
     *
     * @param integer $pageId
     *
     * @return PagePartRef
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * Get pageId
     *
     * @return integer
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Set pageEntityname
     *
     * @param string $pageEntityname
     *
     * @return PagePartRef
     */
    public function setPageEntityname($pageEntityname)
    {
        $this->pageEntityname = $pageEntityname;

        return $this;
    }

    /**
     * Get pageEntityname
     *
     * @return string
     */
    public function getPageEntityname()
    {
        return $this->pageEntityname;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return PagePartRef
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set sequencenumber
     *
     * @param integer $sequencenumber
     *
     * @return PagePartRef
     */
    public function setSequencenumber($sequencenumber)
    {
        $this->sequencenumber = $sequencenumber;

        return $this;
    }

    /**
     * Get sequencenumber
     *
     * @return integer
     */
    public function getSequencenumber()
    {
        return $this->sequencenumber;
    }

    /**
     * Set pagePartId
     *
     * @param integer $pagePartId
     *
     * @return PagePartRef
     */
    public function setPagePartId($pagePartId)
    {
        $this->pagePartId = $pagePartId;

        return $this;
    }

    /**
     * Get pagePartId
     *
     * @return integer
     */
    public function getPagePartId()
    {
        return $this->pagePartId;
    }

    /**
     * Set pagePartEntityName
     *
     * @param string $pagePartEntityName
     *
     * @return PagePartRef
     */
    public function setPagePartEntityName($pagePartEntityName)
    {
        $this->pagePartEntityName = $pagePartEntityName;

        return $this;
    }

    /**
     * Get pagePartEntityName
     *
     * @return string
     */
    public function getPagePartEntityName()
    {
        return $this->pagePartEntityName;
    }



}

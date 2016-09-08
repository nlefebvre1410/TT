<?php

namespace Acme\ContentBundle\Entity;

use Acme\ContentBundle\Form\ContentType;
use Cz\ManagerBundle\Entity\AbstractEntity;
use Cz\ManagerBundle\Entity\HasNodeInterface;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;
use Cz\PagesPartBundle\Helper\HasPageTemplateInterface;
use Cz\PagesPartBundle\PagePartAdmin\PagePartAdminConfiguratorInterface;
use Cz\PagesPartBundle\PageTemplate\PageTemplateInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManager;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Content
 * @ORM\Table(name="content_url", indexes={@ORM\Index(name="idx_cz_lookup", columns={"ref_id", "ref_entity_name"})})
 * @ORM\Entity(repositoryClass="Acme\ContentBundle\Repository\ContentRepository")
 *
 */
class Content
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * Bidirectional - Many comments are favorited by many users (INVERSE SIDE)
     *
     * @ORM\ManyToMany(targetEntity="Acme\ContentBundle\Entity\UrlContents", mappedBy="content")
     */
    private $urlcontent;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $lang;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $online = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Gedmo\Slug(fields={"title"})
     * @Assert\Regex("/^[a-zA-Z0-9\-_\/]+$/")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="ref_entity_name")
     */
    protected $refEntityName;
    /**
     * @var int
     *
     * @ORM\Column(type="bigint", name="ref_id")
     *
     */
    protected $refId;



    public function __construct(UrlContents $urlContents = null)
    {
        $this->urlcontent = $urlContents;
        $this->refEntityName = 'Acme\ContentBundle\Entity\Content';
        $this->refId= 1;


    }


    /**
     * @return mixed
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;


    }


    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return boolean
     */
    public function isOnline()
    {
        return $this->online;
    }

    /**
     * @param boolean $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'AcmeContentBundle:Pages\HomePage:view.html.twig';
    }


    /**
     * Set reference entity name
     *
     * @param string $refEntityName
     *
     * @return NodeVersion
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
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ContentType();
    }


    public function getPageEntity()
    {

    }

    /**
     * @return PageTemplateInterface[]
     */
    public function getPageTemplates()
    {
        return array('CzTestLangBundle:homepage');
    }

    /**
     * Get online
     *
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }
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
     * @return NodeVersion
     */
    protected function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }




    /**
     * @param HasNodeInterface $entity
     *
     * @return NodeVersion
     */
    public function setRef($nb)
    {

        $this->setRefId($nb);
//        $this->setRefEntityName(ClassLookup::getClass($entity));

        return $this;
    }

    /**
     * @param EntityManager $em
     *
     * @return HasNodeInterface
     */
    public function getRef(EntityManager $em)
    {
        return $em->getRepository($this->getRefEntityName())->find($this->getRefId());
    }



    /**
     * Add urlcontent
     *
     * @param \Acme\ContentBundle\Entity\UrlContents $urlcontent
     *
     * @return Content
     */
    public function addUrlcontent(\Acme\ContentBundle\Entity\UrlContents $urlcontent)
    {
        $this->urlcontent[] = $urlcontent;

        return $this;
    }
    public function setUrlContent(\Acme\ContentBundle\Entity\UrlContents $urlcontent)
    {
        $this->urlcontent[] = $urlcontent;

        return $this;
    }

    /**
     * Remove urlcontent
     *
     * @param \Acme\ContentBundle\Entity\UrlContents $urlcontent
     */
    public function removeUrlcontent(\Acme\ContentBundle\Entity\UrlContents $urlcontent)
    {
        $this->urlcontent->removeElement($urlcontent);
    }

    /**
     * Get urlcontent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrlcontent()
    {
        return $this->urlcontent;
    }


}

<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 03/09/2016
 * Time: 21:15
 */

namespace Acme\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cz\ManagerBundle\Entity\AbstractEntity;
use Acme\ContentBundle\Entity\Content;
/**
 * Content
 *
 * @ORM\Table(name="content_urls")
 * @ORM\Entity()
 */
class UrlContents extends AbstractEntity
{


    /**
     * Unidirectional - Many users have marked many comments as read
     *
     * @ORM\ManyToMany(targetEntity="Acme\ContentBundle\Entity\Content", cascade={"persist", "remove"})
     */
    private $content;


    public function __construct()
    {
        $this->content = new ArrayCollection();
    }


    /**
     * @param mixed $id
     */
    public function setRefs(Content $ref)
    {
        $ref->setRef($this);

    }



    /**
     * Add content
     *
     * @param \Acme\ContentBundle\Entity\Content $content
     *
     * @return UrlContents
     */
    public function addContent(\Acme\ContentBundle\Entity\Content $content)
    {
        if (!$this->content->contains($content)) {
            $this->content->add($content);
        }
    }

    /**
     * Remove content
     *
     * @param \Acme\ContentBundle\Entity\Content $content
     */
    public function removeContent(\Acme\ContentBundle\Entity\Content $content)
    {
        $this->content->removeElement($content);
    }

    /**
     * Get content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContent()
    {
        return $this->content;
    }
}

<?php

namespace Cz\AdminBundle\Entity;

use Cz\ManagerBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Media
 *
 * @ORM\Table("cz_adminbundle_media")
 * @ORM\Entity(repositoryClass="Cz\AdminBundle\Repository\MediaAdminRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MediaAdmin extends AbstractEntity
{

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="updated_at",type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }
    

    /**
     * @ORM\Column(type="string",length=255, nullable=true) 
     */
    private $path;
    
    public $file;
    
    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/uploads';
    }
    public function getUploadRootDir2()
    {
        return '/../../../../web/uploads';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getAssetPath()
    {
        return 'uploads/'.$this->path;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
            
            if ($this->oldFile != null) unlink($this->tempFile);
        }
    }
    
    /**
     * @ORM\PreRemove() 
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }
    
    /**
     * @ORM\PostRemove() 
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }


    public function getPath()
    {
        return $this->path;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    
    /**
     * Set path
     *
     * @param string $path
     * @return String
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
    
    /**
     * Set alt
     *
     * @param string $alt
     * @return String
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }
        


    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return MediaAdmin
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }



}

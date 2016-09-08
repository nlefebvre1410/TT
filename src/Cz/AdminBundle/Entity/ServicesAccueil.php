<?php

namespace Cz\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServicesAccueil
 *
 * @ORM\Table(name="cz_adminbundle_services_accueil")
 * @ORM\Entity
 */
class ServicesAccueil extends \Cz\ManagerBundle\Entity\AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="icons1", type="string", length=255)
     */
    private $icons1;

    /**
     * @var string
     *
     * @ORM\Column(name="title1", type="string", length=255)
     */
    private $title1;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif1", type="text")
     */
    private $descriptif1;

    /**
     * @var string
     *
     * @ORM\Column(name="icons2", type="string", length=255)
     */
    private $icons2;

    /**
     * @var string
     *
     * @ORM\Column(name="title2", type="string", length=255)
     */
    private $title2;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif2", type="text")
     */
    private $descriptif2;

    /**
     * @var string
     *
     * @ORM\Column(name="icons3", type="string", length=255)
     */
    private $icons3;

    /**
     * @var string
     *
     * @ORM\Column(name="title3", type="string", length=255)
     */
    private $title3;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif3", type="text")
     */
    private $descriptif3;

    /**
     * @var string
     *
     * @ORM\Column(name="icons4", type="string", length=255)
     */
    private $icons4;

    /**
     * @var string
     *
     * @ORM\Column(name="title4", type="string", length=255)
     */
    private $title4;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif4", type="text")
     */
    private $descriptif4;


    /**
     * Set icons1
     *
     * @param string $icons1
     *
     * @return ServicesAccueil
     */
    public function setIcons1($icons1)
    {
        $this->icons1 = $icons1;

        return $this;
    }

    /**
     * Get icons1
     *
     * @return string
     */
    public function getIcons1()
    {
        return $this->icons1;
    }

    /**
     * Set title1
     *
     * @param string $title1
     *
     * @return ServicesAccueil
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title1
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set descriptif1
     *
     * @param string $descriptif1
     *
     * @return ServicesAccueil
     */
    public function setDescriptif1($descriptif1)
    {
        $this->descriptif1 = $descriptif1;

        return $this;
    }

    /**
     * Get descriptif1
     *
     * @return string
     */
    public function getDescriptif1()
    {
        return $this->descriptif1;
    }

    /**
     * Set icons2
     *
     * @param string $icons2
     *
     * @return ServicesAccueil
     */
    public function setIcons2($icons2)
    {
        $this->icons2 = $icons2;

        return $this;
    }

    /**
     * Get icons2
     *
     * @return string
     */
    public function getIcons2()
    {
        return $this->icons2;
    }

    /**
     * Set title2
     *
     * @param string $title2
     *
     * @return ServicesAccueil
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

        return $this;
    }

    /**
     * Get title2
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set descriptif2
     *
     * @param string $descriptif2
     *
     * @return ServicesAccueil
     */
    public function setDescriptif2($descriptif2)
    {
        $this->descriptif2 = $descriptif2;

        return $this;
    }

    /**
     * Get descriptif2
     *
     * @return string
     */
    public function getDescriptif2()
    {
        return $this->descriptif2;
    }

    /**
     * Set icons3
     *
     * @param string $icons3
     *
     * @return ServicesAccueil
     */
    public function setIcons3($icons3)
    {
        $this->icons3 = $icons3;

        return $this;
    }

    /**
     * Get icons3
     *
     * @return string
     */
    public function getIcons3()
    {
        return $this->icons3;
    }

    /**
     * Set title3
     *
     * @param string $title3
     *
     * @return ServicesAccueil
     */
    public function setTitle3($title3)
    {
        $this->title3 = $title3;

        return $this;
    }

    /**
     * Get title3
     *
     * @return string
     */
    public function getTitle3()
    {
        return $this->title3;
    }

    /**
     * Set descriptif3
     *
     * @param string $descriptif3
     *
     * @return ServicesAccueil
     */
    public function setDescriptif3($descriptif3)
    {
        $this->descriptif3 = $descriptif3;

        return $this;
    }

    /**
     * Get descriptif3
     *
     * @return string
     */
    public function getDescriptif3()
    {
        return $this->descriptif3;
    }

    /**
     * Set icons4
     *
     * @param string $icons4
     *
     * @return ServicesAccueil
     */
    public function setIcons4($icons4)
    {
        $this->icons4 = $icons4;

        return $this;
    }

    /**
     * Get icons4
     *
     * @return string
     */
    public function getIcons4()
    {
        return $this->icons4;
    }

    /**
     * Set title4
     *
     * @param string $title4
     *
     * @return ServicesAccueil
     */
    public function setTitle4($title4)
    {
        $this->title4 = $title4;

        return $this;
    }

    /**
     * Get title4
     *
     * @return string
     */
    public function getTitle4()
    {
        return $this->title4;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return ServicesAccueil
     */
    public function setDescriptif4($descriptif4)
    {
        $this->descriptif4 = $descriptif4;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif4()
    {
        return $this->descriptif4;
    }
}


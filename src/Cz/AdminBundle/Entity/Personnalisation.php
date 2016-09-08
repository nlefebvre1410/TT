<?php

namespace Cz\AdminBundle\Entity;

use Cz\ManagerBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Personnalisation
 *
 * @ORM\Table(name="cz_adminbundle_personnalisation")
 * @ORM\Entity(repositoryClass="Cz\AdminBundle\Repository\PersonnalisationRepository")
 */
class Personnalisation extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="typo", type="string", length=255)
     */
    private $typo;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="referencement", type="string", length=255)
     */
    private $referencement;


    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Personnalisation
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Personnalisation
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set typo
     *
     * @param string $typo
     *
     * @return Personnalisation
     */
    public function setTypo($typo)
    {
        $this->typo = $typo;

        return $this;
    }

    /**
     * Get typo
     *
     * @return string
     */
    public function getTypo()
    {
        return $this->typo;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Personnalisation
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set referencement
     *
     * @param string $referencement
     *
     * @return Personnalisation
     */
    public function setReferencement($referencement)
    {
        $this->referencement = $referencement;

        return $this;
    }

    /**
     * Get referencement
     *
     * @return string
     */
    public function getReferencement()
    {
        return $this->referencement;
    }
}


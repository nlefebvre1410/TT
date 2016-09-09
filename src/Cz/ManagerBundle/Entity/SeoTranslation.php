<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 09/09/2016
 * Time: 11:02
 */

namespace Cz\ManagerBundle\Entity;
use Cz\ManagerBundle\Form\SeoType;
use Cz\ManagerBundle\Helper\Utils\ClassLookup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;

/**
 * @ORM\Entity(repositoryClass="Cz\ManagerBundle\Repository\SeoRepository")
 * @ORM\Table(name="cz_seo_manager_translation")})
 */
class SeoTranslation implements OneLocaleInterface
{
use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", nullable=true)
     * @Assert\Length(max=55)
     *
     */
    protected $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     * @Assert\Length(max=155)
     *
     */
    protected $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_author", type="string", nullable=true)
     */
    protected $metaAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_robots", type="string", nullable=true)
     */
    protected $metaRobots;

    /**
     * @var string
     *
     * @ORM\Column(name="og_type", type="string", nullable=true)
     */
    protected $ogType;

    /**
     * @var string
     *
     * @ORM\Column(name="og_title", type="string", nullable=true)
     */
    protected $ogTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="og_description", type="text", nullable=true)
     */
    protected $ogDescription;


    /**
     * @var string
     *
     * @ORM\Column(name="extra_metadata", type="text", nullable=true)
     */
    protected $extraMetadata;


    /**
     * @ORM\Column(type="string", nullable=true, name="og_url")
     */
    protected $ogUrl;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, name="og_article_author")
     */
    protected $ogArticleAuthor;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, name="og_article_publisher")
     */
    protected $ogArticlePublisher;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, name="og_article_section")
     */
    protected $ogArticleSection;

    /**
     * @var string $twitterTitle
     *
     * @ORM\Column(name="twitter_title", type="string", length=255, nullable=true)
     */
    protected $twitterTitle;

    /**
     * @var string $twitterTitle
     *
     * @ORM\Column(name="twitter_description", type="text", nullable=true)
     */
    protected $twitterDescription;

    /**
     * @var string $twitterTitle
     *
     * @ORM\Column(name="twitter_site", type="string", length=255, nullable=true)
     */
    protected $twitterSite;

    /**
     * @var string $twitterTitle
     *
     * @ORM\Column(name="twitter_creator", type="string", length=255, nullable=true)
     */
    protected $twitterCreator;

    /**
     * @param string $url
     *
     * @return Seo
     */
    public function setOgUrl($url)
    {
        $this->ogUrl = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getOgUrl()
    {
        return $this->ogUrl;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $title
     *
     * @return string
     */
    public function setMetaTitle($title)
    {
        $this->metaTitle = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaAuthor()
    {
        return $this->metaAuthor;
    }

    /**
     * @param string $meta
     *
     * @return Seo
     */
    public function setMetaAuthor($meta)
    {
        $this->metaAuthor = $meta;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $meta
     *
     * @return Seo
     */
    public function setMetaDescription($meta)
    {
        $this->metaDescription = $meta;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaRobots()
    {
        return $this->metaRobots;
    }

    /**
     * @param string $meta
     *
     * @return Seo
     */
    public function setMetaRobots($meta)
    {
        $this->metaRobots = $meta;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraMetadata()
    {
        return $this->extraMetadata;
    }

    /**
     * @param string $extraMetadata
     *
     * @return Seo
     */
    public function setExtraMetadata($extraMetadata)
    {
        $this->extraMetadata = $extraMetadata;

        return $this;
    }

    /**
     * @param string $ogDescription
     *
     * @return Seo
     */
    public function setOgDescription($ogDescription)
    {
        $this->ogDescription = $ogDescription;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgDescription()
    {
        return $this->ogDescription;
    }



    /**
     * @param string $ogTitle
     *
     * @return Seo
     */
    public function setOgTitle($ogTitle)
    {
        $this->ogTitle = $ogTitle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgTitle()
    {
        return $this->ogTitle;
    }

    /**
     * @param string $ogType
     *
     * @return Seo
     */
    public function setOgType($ogType)
    {
        $this->ogType = $ogType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgType()
    {
        return $this->ogType;
    }

    /**
     * @return mixed
     */
    public function getOgArticleAuthor()
    {
        return $this->ogArticleAuthor;
    }

    /**
     * @param mixed $ogArticleAuthor
     */
    public function setOgArticleAuthor($ogArticleAuthor)
    {
        $this->ogArticleAuthor = $ogArticleAuthor;
    }

    /**
     * @return mixed
     */
    public function getOgArticlePublisher()
    {
        return $this->ogArticlePublisher;
    }

    /**
     * @param mixed $ogArticlePublisher
     */
    public function setOgArticlePublisher($ogArticlePublisher)
    {
        $this->ogArticlePublisher = $ogArticlePublisher;
    }

    /**
     * @return mixed
     */
    public function getOgArticleSection()
    {
        return $this->ogArticleSection;
    }

    /**
     * @param mixed $ogArticleSection
     */
    public function setOgArticleSection($ogArticleSection)
    {
        $this->ogArticleSection = $ogArticleSection;
    }

    /**
     * @return string
     */
    public function getTwitterTitle()
    {
        return $this->twitterTitle;
    }

    /**
     * @param string $twitterTitle
     */
    public function setTwitterTitle($twitterTitle)
    {
        $this->twitterTitle = $twitterTitle;
    }

    /**
     * @return string
     */
    public function getTwitterDescription()
    {
        return $this->twitterDescription;
    }

    /**
     * @param string $twitterDescription
     */
    public function setTwitterDescription($twitterDescription)
    {
        $this->twitterDescription = $twitterDescription;
    }

    /**
     * @return string
     */
    public function getTwitterSite()
    {
        return $this->twitterSite;
    }

    /**
     * @param string $twitterSite
     */
    public function setTwitterSite($twitterSite)
    {
        $this->twitterSite = $twitterSite;
    }

    /**
     * @return string
     */
    public function getTwitterCreator()
    {
        return $this->twitterCreator;
    }

    /**
     * @param string $twitterCreator
     */
    public function setTwitterCreator($twitterCreator)
    {
        $this->twitterCreator = $twitterCreator;
    }

    /**
     * @return Media
     */
    public function getTwitterImage()
    {
        return $this->twitterImage;
    }

    /**
     * @param Media $twitterImage
     */
    public function setTwitterImage($twitterImage)
    {
        $this->twitterImage = $twitterImage;
    }


}


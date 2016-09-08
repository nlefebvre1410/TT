<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 02/09/2016
 * Time: 17:29
 */

namespace Cz\ManagerBundle\Event;

use Acme\ContentBundle\Entity\Content;
use Cz\AdminBundle\Entity\ChambreGenerale;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;


class UrlEvent extends Event
{
  protected $content;


    public function __construct(ChambreGenerale $chambreGenerale)
    {

        $this->chambre = $chambreGenerale;
    }

    /**
     * @return mixed
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * @param mixed $chambre
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;
    }
}
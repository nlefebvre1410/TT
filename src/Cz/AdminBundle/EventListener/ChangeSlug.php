<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 11/08/2016
 * Time: 21:41
 */

namespace Cz\AdminBundle\EventListener;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\ORM\Mapping\ClassMetaData,
    Doctrine\ORM\Query\Filter\SQLFilter;
class ChangeSlug
{
  public function change(GetResponseEvent $event)
  {
//      var_dump();
//      die();
      // Check if the entity implements the right interface

  }

}
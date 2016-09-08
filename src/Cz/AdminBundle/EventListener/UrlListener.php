<?php
/**
 * Created by PhpStorm.
 * User: nicolaslefebvre
 * Date: 02/09/2016
 * Time: 23:02
 */

namespace Cz\AdminBundle\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Cz\AdminBundle\Event\CzEvents;
use Cz\AdminBundle\Event\UrlEvent;
class UrlListener  implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
           CzEvents::ADD_URL => 'inserMethod'
        );
    }
    public function inserMethod(UrlEvent $event)
    {
//        dump($event->getChambre()->getParent());
//        die();
      return '';
    }
}
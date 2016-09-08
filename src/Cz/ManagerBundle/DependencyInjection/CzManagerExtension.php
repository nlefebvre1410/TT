<?php

namespace Cz\ManagerBundle\DependencyInjection;

use InvalidArgumentException;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;


/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CzManagerExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config =  $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');


    }
    public function prepend(ContainerBuilder $container){
        $fosUserConfig['db_driver']                     = 'orm'; // other valid values are 'mongodb', 'couchdb'
        $fosUserConfig['firewall_name']                 = 'main';
        $fosUserConfig['user_class']                    = 'Cz\ManagerBundle\Entity\User';
        $fosUserConfig['group']['group_class']          = 'Cz\ManagerBundle\Entity\Group';
        $fosUserConfig['resetting']['token_ttl']        = 86400;
        // Use this node only if you don't want the global email address for the resetting email
        $fosUserConfig['resetting']['email']['from_email']['address']        = 'admin@czmultimedia.fr';
        $fosUserConfig['resetting']['email']['from_email']['sender_name']    = 'admin';
        $fosUserConfig['resetting']['email']['template']    = 'FOSUserBundle:Resetting:email.txt.twig';
        $fosUserConfig['resetting']['form']['type']                 = 'fos_user_resetting';
        $fosUserConfig['resetting']['form']['name']                 = 'fos_user_resetting_form';
        $fosUserConfig['resetting']['form']['validation_groups']    = ['ResetPassword'];
        $container->prependExtensionConfig('fos_user', $fosUserConfig);
    }
    private function addSimpleMenuAdaptor(ContainerBuilder $container, array $menuItems)
    {
        $definition = new Definition('Cz\ManagerBundle\Helper\Menu\SimpleMenuAdaptor', [
            new Reference('security.authorization_checker'),
            $menuItems
        ]);
        $definition->addTag('cz_manager.menu.adaptor');

        $container->setDefinition('cz_manager.menu.adaptor.simple', $definition);
    }
}

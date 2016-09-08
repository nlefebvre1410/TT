<?php

namespace Cz\ManagerBundle\DependencyInjection\Complier;

    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\Reference;

    /**
     * This compiler pass makes it possible to adapt the menu
     */
    class MenuCompilerPass implements CompilerPassInterface
    {
        /**
         * @param ContainerBuilder $container
         */
        public function process(ContainerBuilder $container)
        {
            if (!$container->hasDefinition('cz_manager.menubuilder')) {
                return;
            }

            $definition = $container->getDefinition('cz_manager.menubuilder');

                foreach ($container->findTaggedServiceIds('cz_manager.menu.adaptor') as $id => $attributes) {
                $priority = isset($attributes[0]['priority']) ? $attributes[0]['priority'] : 0;
                $definition->addMethodCall('addAdaptMenu', array(new Reference($id), $priority));

                 }
        }

}

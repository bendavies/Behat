<?php

/*
 * This file is part of the Behat Testwork.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Testwork\Filesystem\ServiceContainer;

use Behat\Testwork\Cli\ServiceContainer\CliExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Testwork filesystem extension.
 *
 * Provides filesystem services for testwork.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class FilesystemExtension implements Extension
{
    /*
     * Available services
     */
    const LOGGER_ID = 'filesystem.logger';

    /**
     * Returns the extension config key.
     *
     * @return string
     */
    public function getConfigKey()
    {
        return 'filesystem';
    }

    /**
     * Setups configuration for the extension.
     *
     * @param ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
    }

    /**
     * Loads extension services into temporary container.
     *
     * @param ContainerBuilder $container
     * @param array            $config
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $this->loadFilesystemLogger($container);
    }

    /**
     * Processes shared container after all extensions loaded.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
    }

    /**
     * Loads filesystem logger.
     *
     * @param ContainerBuilder $container
     */
    protected function loadFilesystemLogger(ContainerBuilder $container)
    {
        $definition = new Definition('Behat\Testwork\Filesystem\ConsoleFilesystemLogger', array(
            '%paths.base%',
            new Reference(CliExtension::OUTPUT_ID)
        ));
        $container->setDefinition(self::LOGGER_ID, $definition);
    }
}

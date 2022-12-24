<?php

namespace Dynamophp\HashBundle\DependencyInjection;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use Dynamophp\HashBundle\Exception\BadHasherSelectionException;
use Dynamophp\HashBundle\Service\DynamoHasherSha256;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class DynamoPhpHashExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadServices($container);

        $configuration = $this->getConfiguration($configs, $container);
        $configurationParsed = $this->processConfiguration($configuration, $configs);

        $this->configureSha256Hasher($container, $configurationParsed);
    }

    private function loadServices(ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('bundle_services.xml');
    }

    /**
     * @throws BadHasherSelectionException
     */
    private function configureSha256Hasher(ContainerBuilder $container, array $configuration): void
    {
        $contextDefinition = $container->getDefinition('hasher_sha256_default_context');

        $startSelection = Configuration::getStartSelection($configuration);
        $endSelection = Configuration::getEndSelection($configuration);

        $this->validateHasherSelection($startSelection, $endSelection, 64);

        $contextDefinition->addArgument($startSelection);
        $contextDefinition->addArgument($endSelection);
    }

    /**
     * @throws BadHasherSelectionException
     */
    private function validateHasherSelection(int $startSelection, int $endSelection, int $maxSelection): void
    {
        if (($startSelection + $endSelection) > $maxSelection) {
            throw new BadHasherSelectionException($maxSelection);
        }

        if ($startSelection < 0 || $endSelection < 0) {
            throw new BadHasherSelectionException($maxSelection);
        }
    }
}
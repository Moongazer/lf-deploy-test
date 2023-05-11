<?php

declare(strict_types=1);

return [
    'name' => 'Lehner Mautic Customization',
    'description' => 'This plugin customizes Mautic for the requirements of Lehner',
    'version' => '1.0.0',
    'author' => 'Leuchtfeuer',
    'routes' => [],
    'menu' => [],
    'services' => [
        'events'  => [
            'mautic.plugin.mauticcustomization.pluginevents.subscriber' => [
                'class' => \MauticPlugin\MauticCustomizationBundle\EventListener\InstallUpdateSubscriber::class,
                'arguments' => [
                    'mautic.model.factory',
                    'translator',
                ],
            ],
        ],
        'integrations' => [
            'mautic.integration.mauticcustomization' => [
                'class' => \MauticPlugin\MauticCustomizationBundle\Integration\MauticCustomizationIntegration::class,
                'tags' => [
                    'mautic.integration',
                    'mautic.basic_integration',
                ],
            ],
            'mauticcustomization.integration.configuration' => [
                'class' => \MauticPlugin\MauticCustomizationBundle\Integration\Support\ConfigSupport::class,
                'tags' => [
                    'mautic.config_integration',
                ],
            ],
        ],
        'command' => [],
        'models' => [],
        'forms' => [],
        'helpers' => [],
        'other' => [
            'mautic.plugin.mauticcustomization.config' => [
                'class' => \MauticPlugin\MauticCustomizationBundle\Integration\Config::class,
                'arguments' => [
                    'mautic.integrations.helper',
                ],
            ],
        ],
    ],
    'parameters' => [],
];

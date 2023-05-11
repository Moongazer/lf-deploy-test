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
            'mautic.customization.pluginbundle.subscriber' => [
                'class' => \MauticPlugin\MauticCustomizationBundle\EventListener\InstallUpdateSubscriber::class,
                'arguments' => [
                    'mautic.model.factory',
                    'translator',
                ],
            ],
        ],
        'integrations' => [],
        'command' => [],
        'models' => [],
        'forms' => [],
        'helpers' => [],
        'other' => [],
    ],
    'parameters' => [],
];

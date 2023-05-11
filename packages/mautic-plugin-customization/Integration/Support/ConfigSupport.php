<?php

declare(strict_types=1);

namespace MauticPlugin\MauticCustomizationBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\MauticCustomizationBundle\Integration\MauticCustomizationIntegration;

class ConfigSupport extends MauticCustomizationIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}

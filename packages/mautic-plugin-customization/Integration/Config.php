<?php

declare(strict_types=1);

namespace MauticPlugin\MauticCustomizationBundle\Integration;

use Mautic\IntegrationsBundle\Exception\IntegrationNotFoundException;
use Mautic\IntegrationsBundle\Helper\IntegrationsHelper;
use Mautic\PluginBundle\Entity\Integration;

class Config
{
    /**
     * @var IntegrationsHelper
     */
    private IntegrationsHelper $integrationsHelper;

    /**
     * @param IntegrationsHelper $integrationsHelper
     */
    public function __construct(IntegrationsHelper $integrationsHelper)
    {
        $this->integrationsHelper = $integrationsHelper;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        try {
            $integration = $this->getIntegrationEntity();
            return (bool)$integration->getIsPublished();
        } catch (IntegrationNotFoundException $e) {
            return false;
        }
    }

    /**
     * @throws IntegrationNotFoundException
     */
    public function getIntegrationEntity(): Integration
    {
        $integrationObject = $this->integrationsHelper->getIntegration(MauticCustomizationIntegration::INTEGRATION_NAME);
        return $integrationObject->getIntegrationConfiguration();
    }
}

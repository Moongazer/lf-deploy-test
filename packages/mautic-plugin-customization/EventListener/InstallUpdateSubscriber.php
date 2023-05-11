<?php

declare(strict_types=1);

namespace MauticPlugin\MauticCustomizationBundle\EventListener;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Exception\DriverException;
use Mautic\CoreBundle\Factory\ModelFactory;
use Mautic\LeadBundle\Entity\LeadField;
use Mautic\LeadBundle\Field\Exception\AbortColumnCreateException;
use Mautic\LeadBundle\Model\FieldModel;
use Mautic\PluginBundle\Event\PluginInstallEvent;
use Mautic\PluginBundle\Event\PluginUpdateEvent;
use Mautic\PluginBundle\PluginEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InstallUpdateSubscriber implements EventSubscriberInterface
{
    protected ModelFactory $modelFactory;

    protected TranslatorInterface $translator;

    public function __construct(ModelFactory $modelFactory, TranslatorInterface $translator)
    {
        $this->modelFactory = $modelFactory;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PluginEvents::ON_PLUGIN_INSTALL => ['onPluginInstall', 0],
            PluginEvents::ON_PLUGIN_UPDATE  => ['onPluginUpdate', 0],
        ];
    }


    /**
     * @throws AbortColumnCreateException
     * @throws SchemaException
     * @throws DBALException
     * @throws DriverException
     */
    public function onPluginInstall(PluginInstallEvent $event)
    {
        $this->createCustomFields();
    }

    /**
     * @throws AbortColumnCreateException
     * @throws SchemaException
     * @throws DBALException
     * @throws DriverException
     */
    public function onPluginUpdate(PluginUpdateEvent $event)
    {
        $this->createCustomFields();
    }

    /**
     * @throws AbortColumnCreateException
     * @throws DBALException
     * @throws DriverException
     */
    private function createCustomFields(): void
    {
        $customFieldsConfigFile = __DIR__ . '/../Config/customfields.php';
        if (!file_exists($customFieldsConfigFile)) {
            return;
        }

        $customFieldGroups = include $customFieldsConfigFile;
        if (!is_array($customFieldGroups)) {
            return;
        }

        /** @var FieldModel $model */
        $model = $this->modelFactory->getModel('lead.field');

        foreach ($customFieldGroups as $objectType => $customFields) {
            $order = 1;
            foreach ($customFields as $alias => $field) {
                $entity = new LeadField();
                $label = $field['label'] ?? $this->translator->trans('mautic.customization.lead.field.' . $alias);
                $entity->setLabel($label)
                    ->setOrder($order)
                    ->setAlias($alias)
                    ->setObject($objectType)
                    ->setType($field['type'] ?? 'text')
                    ->setProperties($field['properties'] ?? [])
                    ->setIsRequired($field['required'] ?? false)
                    ->setIsUniqueIdentifer($field['unique'] ?? false)
                    ->setIsFixed($field['fixed'] ?? true)
                    ->setIsListable($field['listable'] ?? false)
                    ->setIsShortVisible($field['short'] ?? false);
                $entity->setGroup($field['group'] ?? 'core');

                if (isset($field['default'])) {
                    $entity->setDefaultValue($field['default']);
                }

                try {
                    $model->saveEntity($entity);
                } catch (\Mautic\CoreBundle\Exception\SchemaException $e) {
                    // ignore exception: "There was an error creating the custom field FIELDNAME because it already exists."
                    // @todo: implementing a proper check if custom-fields exist already might be more appropriate
                }
                $order++;
            }
        }
    }
}

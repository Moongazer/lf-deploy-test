# Mautic project customization

This plugin customizes the Mautic project for the requirements of Lehner.

It acts as "site-package" where all other plugins should have a dependency to it, e.g. when using custom-fields. By
this way it is guarantied, that project-related changes in Mautic are available to all project-related plugins.

## Usage

### Add custom-fields programmatically

To add custom-fields which are installed with the plugin, add or modify the file `Config/customfields.php` to return
an array where the outer keys represent the object-type (`lead|company`) and the inner keys defining the custom-field
settings:
```php
<?php

return [
    'lead' => [
        'my_custom_field_alias' => [ // the array-key is used as field-alias and must be unique (prefix it with a vendor sign is recommended)
            'label' => 'My Custom-Field Name', // optional (default is to load "mautic.customization.lead.field.my_custom_field_alias" from translation file)
            'group' => 'personal', // optional, can be "core|personal|professional|social" (default is "core")
            'type' => 'number', // optional, can be any type of field "Data Type" (default is "text")
            'properties' => ['roundmode' => 3, 'scale' => 0], // optional, might be required depending on type (default is [])
            'default' => null, //  optional (default is null)
            'unique' => true, // optional (default is false)
            'fixed' => true, // optional (default is true)
            'listable' => true, // optional (default is false)
            'short' => true, // optional (default is false)
            'required' => false, // optional (default is false)
        ],
    ],
    'company' => [
        // define custom-fields for the "company" object here
    ],
];
```
> Note: After adding a new custom-field, don't forget to increase the `version` in `Config/config.php` and clear the
> cache, so `mautic:plugins:reload` will execute the update-method to add the new fields.

### Add project-related commands

Add project-related commands to a `Command/` directory if they don't belong to any specific customer plugin used by
this project.

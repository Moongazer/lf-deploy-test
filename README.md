# Leuchtfeuer Mautic Project-Template

This `composer.json` is based on `mautic/recommended-project` but adds `leuchtfeuer/mautic-distribution` as dependency,
to setup new projects based on the Mautic Leuchtfeuer distribution using Composer.

## Usage
1. Create a new project folder, e.g. `vendor-mautic-project`.
2. Copy this `composer.json` into the folder.
3. Modify the name-attribute of the `composer.json`, e.g. `leuchtfeuer/vendor-mautic-project`.
4. Run `composer install`. If Composer complains about wrong PHP versions, it's recommended to setup DDEV (see below).

## Setup DDEV for project
For the following steps to work, DDEV has to be installed (see [DDEV installation](https://ddev.readthedocs.io/en/latest/users/install/ddev-installation/)) 
1. Open the project folder, e.g. `vendor-mautic-project`.
2. Execute `ddev config` and give the following settings:
   ```
   Project name: vendor-mautic-project
   Docroot Location: docroot (say "yes" if it asks for creation)
   Project Type: php
   ```
3. Open the DDEV config file `.ddev/config.yaml` and modify or set the following values:
   ```yaml
   php_version: "7.4"
   webserver_type: apache-fpm
   webimage_extra_packages: [php7.4-imap]
   ```
4. Run `ddev start` and enter the container shell with `ddev ssh` after start completed.
5. Execute `composer install` here to run Composer in the right environment, e.g. under PHP 7.4 in this case.

## Require project related dependencies
To add project related dependencies, execute `composer require publishername/some-mautic-plugin`.

Sometimes it is useful to maintain project related packages in the project-repository itself (means, it is not
necessary to have an individual repository for each customer related plugin or theme). This can be done by adding
a folder called `packages` to the project-root where each plugin or theme is placed in a sub-folder. Add the
following configuration to the project's `composer.json` to install the plugins or themes directly from this folder:
```json
"repositories": [
    {
        "type": "path",
        "url": "packages/*",
        "symlink": true
    }
]
```

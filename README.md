# Lehner Mautic

## Usage

### Mautic customization plugin
Each customer project comes with an installed "Mautic customization plugin" skeleton (see `./packages/mautic-plugin-customization`).
This plugin acts as main-plugin (or "base bundle") which holds project-related customizations, e.g. programmatically
defined custom-fields, if other plugins depending on such custom-fields. But also common event-subscriber oder services
which are not related to any other project-related plugin should be added here. See plugin
[README](./packages/mautic-plugin-customization/README.md) for further details.

### Composer patches
The project setup integrates [cweagans/composer-patches](https://github.com/cweagans/composer-patches) to apply locally
stored patch-files via Composer install/update. This allows the modification of Mautic core classes or any other
vendor package.

> Note: using composer-patches should be always the last option! Try to use custom plugins or extending features offered
> by Mautic as much as possible.

To modify a Mautic core or vendor package file, follow the these steps:
1. Create new folders in `./patches/` reflecting the Composer namespace of the target package (e.g. `./patches/mautic/core-lib`).
2. Copy the desired patch-file into this folder and give it a clear naming for reference (e.g. `pr-mtc2755-exit-codes.patch`).
3. Edit the file `./patches/composer.patches.json` to configure the target package and the patch-file:
   ```json
   {
     "patches": {
       "mautic/core-lib": {
         "MTC 2755 added error exit codes to some mautic commands": "patches/mautic/core-lib/pr-mtc2755-exit-codes.patch"
       }
     }
   }
   ```
4. Run  `composer update` to apply the patches. On every Composer install/update, the configured patches are applied
automatically via Composer's post-hook.

> Note: it is NOT possible to apply patches given by URL to private repositories! (See issue [#507](https://github.com/cweagans/composer-patches/issues/507) for reference).

See [official docs](https://docs.cweagans.net/composer-patches/) for further configuration options and recommended workflows.

### Mautic Scaffold
To modify static assets or files, the project setup ships with `mautic/core-composer-scaffold` which is executed on any
Composer install/update run. See [README](./packages/mautic-scaffold/README.md) for further details.

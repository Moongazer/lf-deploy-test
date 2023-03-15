<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'https://github.com/Moongazer/lf-deploy-test.git'); // git@github.com:Moongazer/lf-deploy-test.git

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('testphp74')
    ->setHostname('testphp74.office.leuchtfeuer.com')
    ->setRemoteUser('zirpel')
    ->set('branch', 'deploy/mautic')
    ->set('deploy_path', '/var/www/zirpel/mautic-deploy-test.zirpel.testphp74')
    ->set('writable_mode', 'chmod') // for shared-host environments where ACL isn't available/installable
    ->set('composer_options', '--ignore-platform-reqs'); // @todo: resolve by installing PHP extensions (ext-bcmath, ext-imap)

host('zircon')
    ->setHostname('w0192e57.kasserver.com')
    ->setRemoteUser('ssh-w01dd476')
    ->set('branch', 'deploy/mautic')
    ->set('deploy_path', '/www/htdocs/w01dd476')
    ->set('writable_mode', 'chmod') // for shared-host environments where ACL isn't available/installable
    ->set('composer_options', '--ignore-platform-reqs'); // @todo: resolve by installing PHP extensions (ext-bcmath, ext-imap)

// Hooks

after('deploy:failed', 'deploy:unlock');

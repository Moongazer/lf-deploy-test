<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'https://github.com/Moongazer/lf-deploy-test.git'); // git@github.com:Moongazer/lf-deploy-test.git

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('zircon')
    ->setHostname('w0192e57.kasserver.com')
    ->setRemoteUser('ssh-w01dd476')
//    ->set('http_user', 'w01dd476') // @todo: why?
    ->set('deploy_path', '/www/htdocs/w01dd476')
    ->set('writable_mode', 'chmod'); // for shared-host environments where ACL isn't available/installable

// Hooks

after('deploy:failed', 'deploy:unlock');

<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:Moongazer/lf-deploy-test.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('zircon')
    ->setHostname('w0192e57.kasserver.com')
    ->setRemoteUser('ssh-w01dd476')
    ->setDeployPath('~/deploy-test');

// Hooks

after('deploy:failed', 'deploy:unlock');

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
    ->hostname('w0192e57.kasserver.com')
    ->set('remote_user', 'ssh-w01dd476')
    ->set('deploy_path', '~/deploy-test');

// Hooks

after('deploy:failed', 'deploy:unlock');

<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:Moongazer/lf-deploy-test.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('my-host-url.net')
    ->set('remote_user', 'my-remoteuser')
    ->set('deploy_path', '~/deploy-test');

// Hooks

after('deploy:failed', 'deploy:unlock');

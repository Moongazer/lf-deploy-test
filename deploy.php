<?php

declare(strict_types=1);

namespace Deployer;

// include base recipes
require 'recipe/symfony.php';
require 'contrib/cachetool.php';

// include hosts
import('.deployment/hosts.yaml');

// base settings
set('repository', 'https://github.com/Moongazer/lf-deploy-test.git'); // git@github.com:Moongazer/lf-deploy-test.git
set('branch', 'deploy/leh');
set('bin/php', 'php');
set('keep_releases', 5);
set('release_name', fn () => run('echo $(date "+%Y-%m-%dT%H-%M-%S")'));
set('mautic_webroot', 'docroot');
set('writable_mode', 'chmod'); // for shared-host environments where ACL isn't available/installable
set('composer_options', '--ignore-platform-reqs'); // @todo: resolve by installing PHP extensions (ext-bcmath, ext-imap)

// set shared directories
$sharedDirectories = [
    '{{mautic_webroot}}/media',
    '/var',
];
set('shared_dirs', $sharedDirectories);

// set shared files
$sharedFiles = [
    '.env',
    '{{mautic_webroot}}/app/config/local.php',
];
set('shared_files', $sharedFiles);

// set writable directories
set('writable_dirs', [
    '{{mautic_webroot}}/app/config',
]);

// define all rsync excludes
/*$exclude = [
    // OS specific files
    '.DS_Store',
    'Thumbs.db',
    // project specific files and directories
    '.ddev',
    '.editorconfig',
    '.fleet',
    '.git*',
    '.idea',
    '.php-cs-fixer.dist.php',
    '.vscode',
    'auth.json',
    'deploy.php',
    'phpstan.neon',
    'phpunit.xml',
    'README*',
    'rector.php',
    'typoscript-lint.yml',
    '/.build',
    '/.deployment',
    '/var',
];*/

// define rsync options
/*set('rsync', [
    'exclude' => array_merge($sharedDirectories, $sharedFiles, $exclude),
    'exclude-file' => false,
    'include' => [],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'az',
    'options' => ['delete'],
    'timeout' => 300,
]);
set('rsync_src', './');*/

// Use rsync to update code during deployment
/*task('deploy:update_code', function () {
    invoke('rsync:warmup');
    invoke('rsync');
});*/

after('deploy:symlink', function () {
    invoke('deploy:cache:clear');
    invoke('cachetool:clear:opcache');
});

// unlock on failed deployment
after('deploy:failed', 'deploy:unlock');

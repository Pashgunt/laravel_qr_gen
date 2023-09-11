<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config
set('application', 'laravel-app');
set('repository', 'https://github.com/Pashgunt/laravel_qr_gen.git');

// Hosts
host('ip server')
    ->set('remote_user', 'deployer')
    ->set('identity_file', '~/.ssh/deployer_id_rsa')
    ->set('deploy_path', '/');

task('deploy', [
    'deploy:prepare',
    'deploy:publish',
    'deploy:success'
]);

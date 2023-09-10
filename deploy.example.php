<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config
set('application', 'laravel-app');
set('repository', 'https://github.com/Pashgunt/laravel_qr_gen.git');

// Hosts
host('ip server')
    ->user('deployer')
    ->identityFile('~/.ssh/deployer_id_rsa')
    ->set('deploy_path', '/');
#!/usr/bin/env php
<?php
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__ . '/../vendor/autoload.php';
set_time_limit(0);
$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'), getenv('SYMFONY_ENV') ? : 'dev');
$app = require __DIR__ . '/../src/app.php';
require __DIR__ . '/../config/' . $env . '.php';
$console = require __DIR__ . '/../src/console.php';
$console->run();

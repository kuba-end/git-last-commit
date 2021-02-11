
<?php
// application.php

require __DIR__.'/vendor/autoload.php';


use Symfony\Component\Console\Application;

$application = new Application();
// ... register commands
$application->add(new Model\WhatTime());
$application->add(new Model\LastCommit());

$application->run();


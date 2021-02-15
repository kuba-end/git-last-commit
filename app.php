<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new KubaEnd\Model\LastCommit());
$application->add(new KubaEnd\Controller\LastCommitFrom());

$application->run();



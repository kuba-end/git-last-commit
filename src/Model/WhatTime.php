<?php

namespace KubaEnd\Model;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WhatTime extends Command
{
    protected static $defaultName = "whatTime";
    protected function configure()
    {
        parent::configure();
        $this
            ->setDescription('Display the curent time')
            ->setHelp('Print the current time to STDOUT') //opt
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $now = new \DateTime();
        $output->writeln('<info>It is now '  . $now->format("H:i a"));

    }
}

<?php

namespace REBELinBLUE\Sainsburys\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic scrapper command
 */
class ScrapperCommand extends Command
{
    protected function configure()
    {
        $this->setName('scrape')
             ->setDescription('Scraps a URL for a list of products');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}

<?php

namespace REBELinBLUE\Sainsburys\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic scrpper command
 */
class ScraperCommand extends Command
{
    protected function configure()
    {
        $this->setName('scrape')
             ->setDescription('Scraps a URL for a list of products')
             ->addOption(
                 'pretty',                        // Option
                 null,                            // Shortcut
                 InputOption::VALUE_NONE,         // Mode
                 'Pretty Prints the JSON output', // Description,
                 null                             // Default
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}

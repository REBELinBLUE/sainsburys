<?php

namespace REBELinBLUE\Sainsburys\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic scrpper command
 */
class ScraperCommand extends Command
{
    /**
     * Configures the command instance.
     *
     * @return void
     */
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
             )
             ->addArgument(
                 'url',                            // Option
                 InputArgument::REQUIRED,          // Mode
                 'URL to scrape'                   // Description
             );
    }

    /**
     * Executes the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pretty = $input->getOption('pretty');
        $url = $input->getArgument('url');

        $scraper = new Scraper;
    }
}

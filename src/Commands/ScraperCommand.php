<?php

namespace REBELinBLUE\Sainsburys\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use REBELinBLUE\Sainsburys\Scraper;
use REBELinBLUE\Sainsburys\Formatters\JsonFormatter;
use REBELinBLUE\Sainsburys\Parsers\ProductTotalParser;

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
             ->setDescription('Scrapes a URL for a list of products')
             ->addOption(
                 'pretty',                       // Option
                 null,                           // Shortcut
                 InputOption::VALUE_NONE,        // Mode
                 'Pretty print the JSON output', // Description,
                 null                            // Default
             )
             ->addArgument(
                 'url',                           // Option
                 InputArgument::REQUIRED,         // Mode
                 'URL to scrape'                  // Description
             );
    }

    /**
     * Executes the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     * @todo Should we catch the exception if there is an invalid URL and present our own message?
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pretty = $input->getOption('pretty');
        $url = $input->getArgument('url');

        if ($output->isVerbose()) {
            $output->writeln('<info>Processing URL ' . $url . '</info>');
        }

        $scraper = new Scraper;
        $products = $scraper->fetchAndProcess($url);

        $calculator = new ProductTotalParser($products);

        $formatter = new JsonFormatter([
            'results' => $products,
            'total'   => $calculator->getTotalPrice()
        ]);

        $formatter->setPretty($pretty);

        if ($output->isVerbose()) {
            if ($pretty) {
                $output->writeln('<info>Enabled pretty printing</info>');
            }

            if (!count($products)) {
                $output->writeln('<error>No results found!</error>');
            }
        }

        $output->writeln($formatter->getFormatted());
    }
}

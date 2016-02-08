<?php

use REBELinBLUE\Sainsburys\Commands\ScraperCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test the Scrape Command
 */
class ScrapeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Text the basic application
     * @return void
     */
    public function testExecute()
    {
        $application = new Application;
        $application->add(new ScraperCommand);

        $command = $application->find('scrape');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName()
        ]);

        $this->assertEmpty($commandTester->getDisplay());
    }
}

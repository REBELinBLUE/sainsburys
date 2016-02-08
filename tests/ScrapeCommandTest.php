<?php

use REBELinBLUE\Sainsburys\Commands\ScrapperCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test the Scrape Command
 */
class ScrapeCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application;
        $application->add(new ScrapperCommand);

        $command = $application->find('scrape');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName()
        ]);

        $this->assertEmpty($commandTester->getDisplay());
    }
}

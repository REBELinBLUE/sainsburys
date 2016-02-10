<?php

namespace REBELinBLUE\Sainsburys\Tests;

use REBELinBLUE\Sainsburys\Commands\ScraperCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Test the Scrape Command
 */
class ScrapeCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Command Tester class
     * @var CommandTester
     */
    private $commandTester;

    /**
     * Sets up the command tester.
     *
     * @return void
     */
    public function setUp()
    {
        $application = new Application;
        $application->add(new ScraperCommand);

        $command = $application->find('scrape');

        $this->commandTester = new CommandTester($command);
    }

    /**
     * Test the verbosity setting works.
     *
     * @return void
     */
    public function testVerbosity()
    {
        $commandTester = $this->commandTester;

        $commandTester->execute([
            'command'   => 'scrape',
            'url'       => 'http://www.google.com'
        ], ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]);

        $this->assertRegExp('#Processing URL http://www.google.com#', $commandTester->getDisplay());
    }

    /**
     * Test the verbosity setting works.
     *
     * @return void
     */
    public function testPrettyVerbosity()
    {
        $commandTester = $this->commandTester;

        $commandTester->execute([
            'command'   => 'scrape',
            'url'       => 'http://www.google.com',
            '--pretty'  => true,
        ], ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]);

        $this->assertRegExp('/Enabled pretty printing/', $commandTester->getDisplay());
    }
}

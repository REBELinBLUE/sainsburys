<?php

/**
 * The actual console runner
 **/

set_time_limit(0);
date_default_timezone_set('Europe/London');

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use REBELinBLUE\Sainsburys\Commands\ScraperCommand;

$application = new Application('Sainsbury\'s Web Scraper', '1.0.0');
$application->add(new ScraperCommand);
$application->run();

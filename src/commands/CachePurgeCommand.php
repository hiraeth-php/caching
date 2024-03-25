<?php

namespace Hiraeth\Caching;

use Exception;
use Hiraeth\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;
use Hiraeth\Caching\PoolManager;
use Psr\Log\LogLevel;

/**
 * A command to purge all caches
 */
class CachePurgeCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'cache:purge';

	/**
	 * @var Application
	 */
	protected $app;

	/**
	 * @var PoolManager
	 */
	protected $poolManager;


	/**
	 * Construct a new command
	 */
	public function __construct(PoolManager $poolManager, Application $app)
	{
		$this->poolManager = $poolManager;
		$this->app         = $app;

		parent::__construct();
	}


	/**
	 * {@inheritDoc}
	 */
	protected function execute(Input $input, Output $output): int
	{
		set_time_limit(0);

		foreach ($this->poolManager->getAll() as $name => $pool) {
			try {
				$pool->clear();
			} catch (Exception $e) {
				$this->app->log(LogLevel::WARNING, sprintf(
					'Error clearing cache on pool "%s", %s',
					$name,
					$e
				));
			}
		}

		return 0;
	}
}

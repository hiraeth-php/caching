<?php

namespace Hiraeth\Caching;

use Exception;
use Hiraeth\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;
use Hiraeth\Caching\PoolManager;
use InvalidArgumentException;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
	 *
	 */
	protected function configure(): void
	{
		$this
			->addOption('all', 'a', InputOption::VALUE_OPTIONAL, 'Force purging all caches', NULL)
			->addArgument('name', InputArgument::IS_ARRAY, 'One or more cache names to purge')
		;

		parent::configure();
	}


	/**
	 * {@inheritDoc}
	 */
	protected function execute(Input $input, Output $output): int
	{
		set_time_limit(0);

		$names = $input->getArgument('name');
		$all   = $input->getOption('all');

		if (!$names && !$all) {
			$output->writeln(
				'You must provide one or more cache names or use the --all option'
			);

			return 1;
		}

		foreach ($this->poolManager->getAll() as $name => $pool) {
			if (!$all && !in_array($name, $names)) {
				continue;
			}

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

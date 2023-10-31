<?php

namespace Hiraeth\Caching;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;
use Hiraeth\Caching\PoolManager;

/**
 * A command to purge all caches
 */
class CachePurgeCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'caching:purge';


	/**
	 * @var PoolManager|null
	 */
	protected $poolManager = NULL;


	/**
	 * Construct a new command
	 */
	public function __construct(PoolManager $poolManager)
	{
		$this->poolManager = $poolManager;

		parent::__construct();
	}


	/**
	 * {@inheritDoc}
	 */
	protected function execute(Input $input, Output $output): int
	{
		set_time_limit(0);

		foreach ($this->poolManager->getAll() as $pool) {
			$pool->clear();
		}

		return 0;
	}
}

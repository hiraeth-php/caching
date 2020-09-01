<?php

namespace Hiraeth\Caching;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;
use Hiraeth\Caching\PoolManager;

/**
 *
 */
class CachePurgeCommand extends Command
{
	/**
	 *
	 */
	protected static $defaultName = 'caching:purge';


	/**
	 * @var PoolManager|null
	 */
	protected $poolManager = NULL;


	/**
	 *
	 */
	public function __construct(PoolManager $poolManager)
	{
		$this->poolManager = $poolManager;

		parent::__construct();
	}


	/**
	 *
	 */
	protected function execute(Input $input, Output $output)
	{
		set_time_limit(0);

		foreach ($this->poolManager->getAll() as $pool) {
			$pool->purge();
		}
	}
}

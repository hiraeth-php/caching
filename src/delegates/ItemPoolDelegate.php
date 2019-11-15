<?php

namespace Hiraeth\Caching;

use Hiraeth;

/**
 *
 */
class ItemPoolDelegate implements Hiraeth\Delegate
{
	/**
	 *
	 */
	protected $manager = NULL;


	/**
	 * {@inheritDoc}
	 */
	static public function getClass(): string
	{
		return ItemPool::class;
	}


	/**
	 * Create a new instance
	 */
	public function __construct(PoolManager $manager)
	{
		$this->manager = $manager;
	}


	/**
	 * {@inheritDoc}
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		return $this->manager->getDefaultPool();
	}
}

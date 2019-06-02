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
	 * Get the class for which the delegate operates.
	 *
	 * @static
	 * @access public
	 * @return string The class for which the delegate operates
	 */
	static public function getClass(): string
	{
		return ItemPool::class;
	}


	/**
	 *
	 */
	public function __construct(PoolManagerInterface $manager)
	{
		$this->manager = $manager;
	}


	/**
	 * Get the instance of the class for which the delegate operates.
	 *
	 * @access public
	 * @param Hiraeth\Application $app The application instance for which the delegate operates
	 * @return object The instance of the class for which the delegate operates
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		return $this->manager->getDefaultPool();
	}
}

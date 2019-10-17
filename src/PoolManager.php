<?php

namespace Hiraeth\Caching;

use Psr\Cache;
use RuntimeException;

/**
 *
 */
class PoolManager implements PoolManagerInterface
{
	/**
	 *
	 */
	protected $default = 'default';


	/**
	 *
	 */
	protected $pools = array();


	/**
	 *
	 */
	public function add($alias, Cache\CacheItemPoolInterface $pool): PoolManagerInterface
	{
		$this->pools[strtolower($alias)] = $pool;

		return $this;
	}


	/**
	 *
	 */
	public function get($alias): Cache\CacheItemPoolInterface
	{
		if (!isset($this->pools[strtolower($alias)])) {
			throw new RuntimeException(sprintf(
				'Cannot get cache pool "%s", no such pool registered',
				$alias
			));
		}

		return $this->pools[strtolower($alias)];
	}


	/**
	 *
	 */
	public function has($alias): bool
	{
		return isset($this->pools[strtolower($alias)]);
	}


	/**
	 *
	 */
	public function getDefaultPool(): Cache\CacheItemPoolInterface
	{
		return $this->get($this->default);
	}


	/**
	 *
	 */
	public function setDefaultPool($alias): PoolManagerInterface
	{
		$this->default = $alias;
	}
}

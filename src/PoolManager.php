<?php

namespace Hiraeth\Caching;

use Psr\Cache;
use RuntimeException;

/**
 *
 */
class PoolManager
{
	/**
	 * @var string The default pool alias
	 */
	protected $default = 'default';


	/**
	 * @var array<string, Cache\CacheItemPoolInterface>
	 */
	protected $pools = array();


	/**
	 *
	 */
	public function add(string $alias, Cache\CacheItemPoolInterface $pool): PoolManager
	{
		$this->pools[strtolower($alias)] = $pool;

		return $this;
	}


	/**
	 *
	 */
	public function get(string $alias): Cache\CacheItemPoolInterface
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
	 * Returns all the Cache Pools
	 *
	 * @return array<string, Cache\CacheItemPoolInterface>
	 */
	public function getAll(): array
	{
		return $this->pools;
	}


	/**
	 *
	 */
	public function has(string $alias): bool
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
	public function setDefaultPool(string $alias): PoolManager
	{
		$this->default = $alias;

		return $this;
	}
}

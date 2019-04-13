<?php

namespace Hiraeth\Caching;

use Psr\Cache;
use RuntimeException;

/**
 *
 */
interface PoolManagerInterface
{
	/**
	 *
	 */
	public function add($alias, Cache\CacheItemPoolInterface $pool): PoolManagerInterface;


	/**
	 *
	 */
	public function get($alias): Cache\CacheItemPoolInterface;


	/**
	 *
	 */
	public function getDefaultPool(): Cache\CacheItemPoolInterface;


	/**
	 *
	 */
	public function setDefaultPool($alias): PoolManagerInterface;
}

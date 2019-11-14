<?php

namespace Hiraeth\Caching;

/**
 *
 */
interface KeyGenerator
{
	/**
	 *
	 */
	public function generateCacheKey(): string;
}

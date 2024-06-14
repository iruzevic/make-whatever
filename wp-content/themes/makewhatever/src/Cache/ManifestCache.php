<?php

/**
 * The file that defines a project config details like prefix, absolute path and etc.
 *
 * @package Makewhatever\Cache
 */

declare(strict_types=1);

namespace Makewhatever\Cache;

use Makewhatever\Config\Config;
use MakewhateverVendor\EightshiftLibs\Cache\AbstractManifestCache;

/**
 * The project config class.
 */
class ManifestCache extends AbstractManifestCache
{
	/**
	 * Get cache name.
	 *
	 * @return string Cache name.
	 */
	public function getCacheName(): string
	{
		return Config::getProjectTextDomain();
	}

	/**
	 * Get cache version.
	 *
	 * @return string
	 */
	public function getVersion(): string
	{
		return Config::getProjectVersion();
	}
}

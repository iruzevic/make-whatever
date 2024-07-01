<?php

/**
 * Class that adds Geolocation detection.
 *
 * @package Makewhatever\Geolocation
 */

declare(strict_types=1);

namespace Makewhatever\Geolocation;

use MakewhateverVendor\EightshiftLibs\Geolocation\AbstractGeolocation;

/**
 * Class Geolocation
 */
class Geolocation extends AbstractGeolocation
{
	/**
	 * Register all the hooks
	 */
	public function register(): void
	{
		\add_action('init', [$this, 'setLocationCookie']);
	}

	/**
	 * Get geolocation cookie name.
	 *
	 * @return string
	 */
	public function getGeolocationCookieName(): string
	{
		return 'es-geolocation';
	}

	/**
	 * Get geolocation executable phar location.
	 *
	 * @return string
	 */
	public function getGeolocationPharLocation(): string
	{
		return __DIR__ . \DIRECTORY_SEPARATOR . 'geoip2.phar';
	}

	/**
	 * Get geolocation database location.
	 *
	 * @return string
	 */
	public function getGeolocationDbLocation(): string
	{
		return __DIR__ . \DIRECTORY_SEPARATOR . 'GeoLite2-Country.mmdb';
	}
}

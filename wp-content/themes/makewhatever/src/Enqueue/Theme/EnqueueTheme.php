<?php

/**
 * The Theme/Frontend Enqueue specific functionality.
 *
 * @package Makewhatever\Enqueue\Theme
 */

declare(strict_types=1);

namespace Makewhatever\Enqueue\Theme;

use Makewhatever\Config\Config;
use Makewhatever\Rest\Routes\LoadMore\LoadMoreRoute;
use MakewhateverVendor\EightshiftLibs\Enqueue\Theme\AbstractEnqueueTheme;

/**
 * Class EnqueueTheme
 */
class EnqueueTheme extends AbstractEnqueueTheme
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('wp_enqueue_scripts', [$this, 'enqueueStyles'], 10);
		\add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
	}

	/**
	 * Method that returns assets name used to prefix asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsPrefix(): string
	{
		return Config::getProjectName();
	}

	/**
	 * Method that returns assets version for versioning asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsVersion(): string
	{
		return Config::getProjectVersion();
	}

	/**
	 * Get script localizations
	 *
	 * @return array<string, mixed>
	 */
	protected function getLocalizations(): array
	{
		$namespace = Config::getProjectRoutesNamespace();
		$version = Config::getProjectRoutesVersion();

		return [
			'esBlocksLocalization' => [
				'loadMoreRestUrl' => \get_rest_url(null, "{$namespace}/{$version}/" . LoadMoreRoute::LOAD_MORE_ROUTE),
			],
		];
	}
}

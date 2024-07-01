<?php

/**
 * The Admin Enqueue specific functionality.
 *
 * @package Makewhatever\Enqueue\Admin
 */

declare(strict_types=1);

namespace Makewhatever\Enqueue\Admin;

use Makewhatever\Config\Config;
use MakewhateverVendor\EightshiftLibs\Enqueue\Admin\AbstractEnqueueAdmin;

/**
 * Class EnqueueAdmin
 *
 * This class handles enqueue scripts and styles.
 */
class EnqueueAdmin extends AbstractEnqueueAdmin
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('login_enqueue_scripts', [$this, 'enqueueStyles']);
		\add_action('admin_enqueue_scripts', [$this, 'enqueueStyles'], 50);
		\add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
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
	 * Get admin script dependencies
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress
	 *
	 * @return array<int, string> List of all the script dependencies.
	 */
	protected function getAdminScriptDependencies(): array
	{
		return ['wp-element', 'wp-i18n', 'wp-api-fetch'];
	}

	/**
	 * Enqueue scripts from AbstractEnqueueBlocks, extended to expose additional data.
	 * Instead of exposing data through localizations, it's now exposed using inline scripts
	 * as ES_ADMIN_DATA.
	 *
	 * @param string $hook Hook name.
	 *
	 * @return void
	 */
	public function enqueueScripts(string $hook): void
	{
		parent::enqueueScripts($hook);

		$data = \wp_json_encode([
			'nonce' => \wp_create_nonce('wp_rest'),
		]);

		$inlineScript = "const ES_ADMIN_DATA = {$data}";

		\wp_add_inline_script($this->getAdminScriptHandle(), $inlineScript, 'before');
	}
}

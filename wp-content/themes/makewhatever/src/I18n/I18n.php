<?php

/**
 * The Language specific functionality.
 *
 * @package Makewhatever\I18n
 */

declare(strict_types=1);

namespace Makewhatever\I18n;

use Makewhatever\Config\Config;
use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;
use MakewhateverVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * Class i18n
 *
 * This class handles theme or admin languages.
 */
class I18n implements ServiceInterface
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('after_setup_theme', [$this, 'loadThemeTextdomain'], 20);
		\add_action('enqueue_block_editor_assets', [$this, 'setScriptTranslations'], 20);
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @return void
	 */
	public function loadThemeTextdomain(): void
	{
		$sep = \DIRECTORY_SEPARATOR;
		\load_theme_textdomain(
			Config::getProjectName(),
			Helpers::getProjectPaths('srcDestination', "I18n{$sep}languages")
		);
	}

	/**
	 * Load the theme text domain for JavaScript translations
	 *
	 * You should export your locales as a JED file named
	 * {textdomain}-{locale}-{handle}.json into the project path
	 * defined below.
	 *
	 * @return void
	 */
	public function setScriptTranslations(): void
	{
		$sep = \DIRECTORY_SEPARATOR;
		$assetsPrefix = Config::getProjectName();
		$handle = "{$assetsPrefix}-block-editor-scripts";
		\wp_set_script_translations(
			$handle,
			Config::getProjectName(),
			Helpers::getProjectPaths('srcDestination', "I18n{$sep}languages")
		);
	}
}
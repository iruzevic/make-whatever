<?php

/**
 * Theme Name: Makewhatever
 * Description: Eightshift Boilerplate is a WordPress starter theme that helps you build better and faster using the modern development tools.
 * Author: Team Eightshift
 * Author URI: https://eightshift.com/
 * Version: 1.0.0
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: makewhatever
 *
 * @package Makewhatever
 */

declare(strict_types=1);

namespace Makewhatever;

use Makewhatever\Cache\ManifestCache;
use Makewhatever\Main\Main;
use MakewhateverVendor\EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Bailout, if the theme is not loaded via Composer.
 */
if (!\file_exists(__DIR__ . '/vendor/autoload.php')) {
	return;
}

/**
 * Require the Composer autoloader.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * Require the Composer autoloader for the prefixed libraries.
 */
if (\file_exists(__DIR__ . '/vendor-prefixed/autoload.php')) {
	require __DIR__ . '/vendor-prefixed/autoload.php';
}

/**
 * Set all the cache for the theme.
 */
if (\class_exists(ManifestCache::class)) {
	(new ManifestCache())->setAllCache();
}

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class)) {
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}

/**
 * Run all WPCLI commands.
 */
if (\class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}

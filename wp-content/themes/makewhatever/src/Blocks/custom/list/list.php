<?php

/**
 * Template for the Lists Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

echo Helpers::render('list', Helpers::props('list', $attributes, [
	'additionalClass' => Helpers::getTwClasses($attributes, $manifest),
]));

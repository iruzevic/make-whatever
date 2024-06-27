<?php

/**
 * Template for the Heading Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

echo Helpers::render('heading', Helpers::props('heading', $attributes, [
	'additionalClass' => Helpers::getTwClasses($attributes, $manifest),
]));

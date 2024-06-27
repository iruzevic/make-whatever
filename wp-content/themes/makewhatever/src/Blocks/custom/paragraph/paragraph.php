<?php

/**
 * Template for the Paragraph Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

echo Helpers::render('paragraph', Helpers::props('paragraph', $attributes, [
	'additionalClass' => Helpers::getTwClasses($attributes, $manifest),
]));

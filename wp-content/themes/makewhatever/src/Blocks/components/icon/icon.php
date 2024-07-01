<?php

/**
 * Icon component template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$iconUse = Helpers::checkAttr('iconUse', $attributes, $manifest);

if (!$iconUse) {
	return;
}

$additionalClass = $attributes['additionalClass'] ?? '';

$iconName = Helpers::checkAttr('iconName', $attributes, $manifest);

if (!isset($manifest['icons'][$iconName])) {
	return;
}

$icon = $manifest['icons'][$iconName];

$className = Helpers::getTwClasses($attributes, $manifest, $additionalClass);

$icon = str_replace('<svg ', "<svg class=\"{$className}\"", $icon);

// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
echo $icon;

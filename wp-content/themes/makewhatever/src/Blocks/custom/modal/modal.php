<?php

/**
 * Modal block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$modalId = Helpers::checkAttr('modalId', $attributes, $manifest);
$modalTitle = Helpers::checkAttr('modalTitle', $attributes, $manifest);

echo Helpers::render('modal', [
	'modalId' => $modalId,
	'modalTitle' => $modalTitle,
	'modalContent' => $renderContent,
]);

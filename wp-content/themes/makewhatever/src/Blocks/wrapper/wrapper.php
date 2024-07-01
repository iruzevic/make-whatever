<?php

/**
 * Wrapper block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$wrapperUse = Helpers::checkAttr('wrapperUse', $attributes, $manifest);

if (!$wrapperUse) {
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $renderContent;
	return;
}

$wrapperId = Helpers::checkAttr('wrapperId', $attributes, $manifest);
?>

<div
	class="<?php echo esc_attr(Helpers::getTwClasses($attributes, $manifest)); ?>"
	<?php if (!empty($wrapperId)) { ?>
		id="<?php echo esc_attr($wrapperId); ?>"
	<?php } ?>
>
	<?php
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $renderContent;
	?>
</div>

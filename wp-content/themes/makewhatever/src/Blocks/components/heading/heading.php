<?php

/**
 * Template for the Heading Component.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$headingUse = Helpers::checkAttr('headingUse', $attributes, $manifest);

if (!$headingUse) {
	return;
}

$additionalClass = $attributes['additionalClass'] ?? '';

$headingContent = Helpers::checkAttr('headingContent', $attributes, $manifest);
$headingTag = Helpers::checkAttr('headingTag', $attributes, $manifest);

if (!$headingContent) {
	return;
}
?>

<<?php echo esc_attr($headingTag); ?>
	data-slug="<?php echo esc_attr(sanitize_title(idn_to_ascii($headingContent))) ?>"
	class="<?php echo esc_attr(Helpers::getTwClasses($attributes, $manifest, $additionalClass)); ?>"
>
	<?php
		// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
		echo $headingContent;
	?>
</<?php echo esc_attr($headingTag); ?>>

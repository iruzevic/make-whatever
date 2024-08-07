<?php

/**
 * Quote component template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);
$additionalClass = $attributes['additionalClass'] ?? '';

$quoteUse = Helpers::checkAttr('quoteUse', $attributes, $manifest);

if (!$quoteUse) {
	return;
}

$quoteText = Helpers::checkAttr('quoteText', $attributes, $manifest);
$quoteAuthor = Helpers::checkAttr('quoteAuthor', $attributes, $manifest);
$quoteShowIcon = Helpers::checkAttr('quoteShowIcon', $attributes, $manifest);

$iconClass = Helpers::getTwPart('icon', $manifest);

$icon = $manifest['resources']['quoteIcon'];
$icon = str_replace('<svg', '<svg class="' . $iconClass . '"', $icon);
$icon = str_replace('<svg', '<svg aria-hidden="true"', $icon);
?>

<figure class="<?php echo esc_attr(Helpers::getTwPart('container', $manifest, $additionalClass)); ?>">
	<?php
	if ($quoteShowIcon) {
		// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
		echo $icon;
	}
	?>

	<blockquote class="<?php echo esc_attr(Helpers::getTwPart('quote-text', $manifest)); ?>">
		<?php echo wp_kses_post($quoteText); ?>
	</blockquote>

	<?php if (!empty($quoteAuthor)) { ?>
		<figcaption class="<?php echo esc_attr(Helpers::getTwPart('author', $manifest)); ?>">
			&mdash;
			<?php echo wp_kses_post($quoteAuthor); ?>
		</figcaption>
	<?php } ?>
</figure>

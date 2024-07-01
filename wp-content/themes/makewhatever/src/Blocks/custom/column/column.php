<?php

/**
 * Column block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$blockClass = Helpers::getTwClasses($attributes, $manifest);
?>

<div class="<?php echo esc_attr($blockClass); ?>" >
	<?php
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $renderContent;
	?>
</div>

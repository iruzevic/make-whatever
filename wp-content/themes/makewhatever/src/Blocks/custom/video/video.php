<?php

/**
 * Template for the Video Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';


?>

<div class="<?php echo esc_attr($blockClass); ?>" >
	<?php
	echo Helpers::render('video', Helpers::props('video', $attributes));
	?>
</div>

<?php

/**
 * Theme options settings screen component template.
 *
 * @package Makewhatever
 */

use Makewhatever\ThemeOptions\ThemeOptions;
use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);
$patterns = wp_json_encode(ThemeOptions::getPatterns());
?>

<input type="hidden" id="es-pattern-data" value="<?php echo esc_attr($patterns); ?>">

<div class="wrap" id="es-theme-options">
	<?php echo esc_html__('Loading...', 'makewhatever'); ?>
</div>

<?php

/**
 * Template for the Admin header/footer picker settings screen.
 *
 * @package Makewhatever
 */

use Makewhatever\AdminMenus\ReusableBlocksHeaderFooter;
use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

$manifest = Helpers::getManifestByDir(__DIR__);
?>

<div class="wrap">
	<?php
	// Show admin messages.
	if (isset($_GET['settings-updated'])) { // phpcs:ignore
		add_settings_error(ReusableBlocksHeaderFooter::ADMIN_MESSAGE_SLUG, 'save_success', __('Settings saved', 'makewhatever'), 'updated');
	}

	// Render update messages.
	settings_errors(ReusableBlocksHeaderFooter::ADMIN_MESSAGE_SLUG);
	?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<form action="options.php" method="post">
			<?php
			// Output settings fields.
			settings_fields(ReusableBlocksHeaderFooter::ADMIN_MENU_SLUG);

			// Output settings sections.
			do_settings_sections(ReusableBlocksHeaderFooter::ADMIN_MENU_SLUG);

			// Render save button.
			submit_button(__('Save', 'makewhatever'));
			?>
		</form>
	</div>
</div>
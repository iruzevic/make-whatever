<?php

/**
 * Main header file
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;
use Makewhatever\AdminMenus\ReusableBlocksHeaderFooter;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	// Head component.
	echo Helpers::render('head');

	wp_head();
	?>
</head>
<body <?php body_class(); ?>>

<?php
// Header reusable block.
$headerPartialId = get_option(ReusableBlocksHeaderFooter::HEADER_PARTIAL) ?? '';
ReusableBlocksHeaderFooter::renderPartial($headerPartialId);
?>

<main class="main-content" id="main-content">

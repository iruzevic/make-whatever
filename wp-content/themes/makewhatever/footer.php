<?php

/**
 * Display footer.
 *
 * @package Makewhatever
 */

use Makewhatever\AdminMenus\ReusableBlocksHeaderFooter;

?>

</main>

<?php
$footerPartialId = get_option(ReusableBlocksHeaderFooter::FOOTER_PARTIAL) ?? '';
ReusableBlocksHeaderFooter::renderPartial($footerPartialId);

wp_footer();
?>
</body>
</html>

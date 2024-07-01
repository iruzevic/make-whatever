<?php

/**
 * Share block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('share', Helpers::props('share', $attributes));

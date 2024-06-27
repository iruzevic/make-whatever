<?php

/**
 * Hero block view template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('hero', Helpers::props('hero', $attributes));

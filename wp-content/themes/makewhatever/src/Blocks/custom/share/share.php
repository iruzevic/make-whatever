<?php

/**
 * Template for the Share block.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('share', Helpers::props('share', $attributes));

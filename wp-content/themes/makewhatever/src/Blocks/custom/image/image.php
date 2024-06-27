<?php

/**
 * Template for the Image Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('image', Helpers::props('image', $attributes));

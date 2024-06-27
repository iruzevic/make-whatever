<?php

/**
 * Template for the Button Block view.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('button', Helpers::props('button', $attributes));

<?php

/**
 * Image block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('image', Helpers::props('image', $attributes));

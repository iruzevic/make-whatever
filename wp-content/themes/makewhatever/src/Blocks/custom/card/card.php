<?php

/**
 * Card block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('card', Helpers::props('card', $attributes));

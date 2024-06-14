<?php

/**
 * Template for the Card Block.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('card', Helpers::props('card', $attributes));

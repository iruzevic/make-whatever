<?php

/**
 * Button block template.
 *
 * @package Makewhatever
 */

use MakewhateverVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('button', Helpers::props('button', $attributes));

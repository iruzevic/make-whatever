<?php

/**
 * File that holds class for TitleAcfMeta custom meta registration.
 *
 * @package Makewhatever\CustomMeta
 */

declare(strict_types=1);

namespace Makewhatever\CustomMeta;

use MakewhateverVendor\EightshiftLibs\CustomMeta\AbstractAcfMeta;

/**
 * Class TitleAcfMeta.
 */
class TitleAcfMeta extends AbstractAcfMeta
{
	/**
	 * Render acf fields.
	 *
	 * @return void
	 */
	public function fields(): void
	{
		if (\function_exists('acf_add_local_field_group')) {
			\acf_add_local_field_group([]);
		}
	}
}

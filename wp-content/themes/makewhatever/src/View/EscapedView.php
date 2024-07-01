<?php

/**
 * The EscapedView specific functionality.
 *
 * @package Makewhatever\View
 */

namespace Makewhatever\View;

use MakewhateverVendor\EightshiftLibs\Services\ServiceInterface;
use MakewhateverVendor\EightshiftLibs\View\AbstractEscapedView;

/**
 * Class EscapedView
 */
class EscapedView extends AbstractEscapedView implements ServiceInterface
{
	/**
	 * Register all the hooks
	 */
	public function register(): void
	{
	}
}

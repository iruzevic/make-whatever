<?php

/**
 * The class register field for example endpoint
 *
 * @package Makewhatever\Rest\Fields
 */

declare(strict_types=1);

namespace Makewhatever\Rest\Fields;

use MakewhateverVendor\EightshiftLibs\Rest\Fields\AbstractField;
use MakewhateverVendor\EightshiftLibs\Rest\CallableFieldInterface;

/**
 * Class TitleCustomField
 */
class TitleCustomField extends AbstractField implements CallableFieldInterface
{
	/**
	 * Method that returns field object type
	 *
	 * Object(s) the field is being registered to, "post"|"term"|"comment" etc.
	 *
	 * @return array<int, string>
	 */
	protected function getObjectType(): array
	{
		return ['example'];
	}

	/**
	 * Get the name of the field you want to register or override
	 *
	 * @return string The attribute name.
	 */
	protected function getFieldName(): string
	{
		return 'title-custom';
	}

	/**
	 * Get callback arguments array
	 *
	 * @return array<string, mixed> Either an array of options for the endpoint, or an array of arrays for multiple methods.
	 */
	protected function getCallbackArguments(): array
	{
		return [
			'get_callback' => [$this, 'fieldCallback'],
		];
	}

	/**
	 * Method that returns rest response
	 *
	 * @param object|array $postObject Post or custom post type object of the request.
	 * @param string       $attr Rest field/attr string identifier from the second parameter
	 *                           of your register_rest_field() declaration.
	 * @param object       $request Full request payload - as a WP_REST_Request object.
	 * @param string       $objectType The object type which the field is registered against.
	 *                                 Typically first parameter of your register_rest_field() declaration.
	 *
	 * @return mixed If response generated an error, WP_Error, if response
	 *               is already an instance, WP_HTTP_Response, otherwise
	 *               returns a new WP_REST_Response instance.
	 */
	public function fieldCallback($postObject, string $attr, object $request, string $objectType) // @phpstan-ignore-line
	{
		return \rest_ensure_response('output data');
	}
}
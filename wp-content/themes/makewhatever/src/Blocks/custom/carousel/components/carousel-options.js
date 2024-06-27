import React from 'react';
import { __ } from '@wordpress/i18n';
import { checkAttr, getAttrKey, getOption } from '@eightshift/frontend-libs-tailwind/scripts';
import { OptionSelect, Spacer, Toggle } from '@eightshift/ui-components';
import { icons } from '@eightshift/ui-components/icons';
import manifest from './../manifest.json';

export const CarouselOptions = ({ attributes, setAttributes }) => {
	const carouselLoop = checkAttr('carouselLoop', attributes, manifest);
	const carouselNavigation = checkAttr('carouselNavigation', attributes, manifest);
	const carouselPagination = checkAttr('carouselPagination', attributes, manifest);
	const carouselItemGap = checkAttr('carouselItemGap', attributes, manifest);

	return (
		<>
			<OptionSelect
				icon={icons.gutter}
				label={__('Item gap', 'makewhatever')}
				value={carouselItemGap}
				onChange={(value) => setAttributes({ [getAttrKey('carouselItemGap', attributes, manifest)]: value })}
				options={getOption('carouselItemGap', attributes, manifest)}
			/>

			<Spacer />

			<Toggle
				icon={icons.loopMode}
				label={__('Loop', 'makewhatever')}
				checked={carouselLoop}
				onChange={(value) => setAttributes({ [getAttrKey('carouselLoop', attributes, manifest)]: value })}
			/>

			<Toggle
				icon={icons.navigationButtons}
				label={__('Prev/next buttons', 'makewhatever')}
				checked={carouselNavigation}
				onChange={(value) => setAttributes({ [getAttrKey('carouselNavigation', attributes, manifest)]: value })}
			/>

			<Toggle
				icon={icons.pagination}
				label={__('Pagination', 'makewhatever')}
				checked={carouselPagination}
				onChange={(value) => setAttributes({ [getAttrKey('carouselPagination', attributes, manifest)]: value })}
			/>
		</>
	);
};

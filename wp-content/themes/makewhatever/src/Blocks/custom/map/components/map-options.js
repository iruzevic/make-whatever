import { __ } from '@wordpress/i18n';
import { checkAttr, getAttrKey, FileSelector } from '@eightshift/frontend-libs-tailwind/scripts';
import {
	Button,
	Repeater,
	RepeaterItem,
	Notice,
	InputField,
	Menu,
	MenuItem,
	RichLabel,
	MenuSeparator,
	Spacer,
	HStack,
	NumberPicker,
	Toggle,
	Expandable,
} from '@eightshift/ui-components';
import { icons } from '@eightshift/ui-components/icons';
import { truncateMiddle } from '@eightshift/ui-components/utilities';
import manifest from '../manifest.json';

export const MapOptions = ({ attributes, setAttributes }) => {
	const mapLayers = checkAttr('mapLayers', attributes, manifest);
	const mapCenterLat = checkAttr('mapCenterLat', attributes, manifest);
	const mapCenterLon = checkAttr('mapCenterLon', attributes, manifest);
	const mapZoom = checkAttr('mapZoom', attributes, manifest);
	const mapInteractions = checkAttr('mapInteractions', attributes, manifest);
	const mapControls = checkAttr('mapControls', attributes, manifest);

	const layerTypes = {
		openStreetMap: {
			icon: icons.mapLayer,
			title: __('OpenStreetMap', 'makewhatever'),
			hasSeparator: true,
		},
		vectorJson: {
			icon: icons.mapLayerJson,
			title: __('Vector map', 'makewhatever'),
			subtitle: __('with JSON styles', 'makewhatever'),
			hasSeparator: true,
		},
		mapBoxVector: {
			icon: icons.mapLayerVector,
			title: __('Mapbox map', 'makewhatever'),
			subtitle: __('Vector tiles', 'makewhatever'),
		},
		mapBoxRaster: {
			icon: icons.mapLayerRaster,
			title: __('Mapbox map', 'makewhatever'),
			subtitle: __('Raster tiles', 'makewhatever'),
			hasSeparator: true,
		},
		mapTilerVector: {
			icon: icons.mapLayerVector,
			title: __('MapTiler tiles', 'makewhatever'),
			subtitle: __('Vector - XYZ (PBF)', 'makewhatever'),
		},
		mapTilerRasterXyz: {
			icon: icons.mapLayerRaster,
			title: __('MapTiler map/tiles', 'makewhatever'),
			subtitle: __('Raster - XYZ', 'makewhatever'),
		},
		mapTilerRasterJson: {
			icon: icons.mapLayerRaster,
			title: __('MapTiler map/tiles', 'makewhatever'),
			subtitle: __('Raster - JSON', 'makewhatever'),
			hasSeparator: true,
		},
		geoJson: { icon: icons.fileMetadata, title: __('GeoJSON', 'makewhatever') },
	};

	return (
		<>
			<Repeater
				icon={icons.layers}
				label={__('Layers', 'makewhatever')}
				items={mapLayers}
				onChange={(value) => setAttributes({ [getAttrKey('mapLayers', attributes, manifest)]: value })}
				addButton={({ addItem, disabled }) => (
					<Menu
						triggerIcon={icons.add}
						triggerProps={{ size: 'small', disabled: disabled }}
					>
						{Object.entries(layerTypes).map(([value, { icon, title, subtitle, hasSeparator }]) => {
							return (
								<>
									<MenuItem
										key={value}
										icon={icon}
										onClick={() => {
											addItem({
												type: value,
												hidden: false,
											});
										}}
									>
										<RichLabel
											label={title}
											subtitle={subtitle}
										/>
									</MenuItem>

									{hasSeparator && <MenuSeparator />}
								</>
							);
						})}
					</Menu>
				)}
			>
				{(layer) => {
					const { type, apiKey, geoJsonUrl, geoJsonId, styleUrl, hidden, updateData } = layer;

					const needsApiKey = [
						'mapBoxVector',
						'mapBoxRaster',
						'mapTilerVector',
						'vectorJson',
						'mapTilerRasterXyz',
						'mapTilerRasterJson',
					].includes(type);
					// eslint-disable-next-line max-len
					const hasMapStyleOptions = [
						'mapBoxVector',
						'mapBoxRaster',
						'mapTilerVector',
						'vectorJson',
						'mapTilerRasterXyz',
						'mapTilerRasterJson',
					].includes(type);

					return (
						<RepeaterItem
							icon={layer?.type ? layerTypes?.[layer?.type]?.icon ?? icons.mapLayer : icons.layerOff}
							label={layerTypes?.[type]?.title ?? __('New layer', 'makewhatever')}
							subtitle={
								type === 'geoJson'
									? truncateMiddle(geoJsonUrl?.slice(geoJsonUrl?.lastIndexOf('/') + 1) ?? '', 20)
									: layerTypes?.[type]?.subtitle
							}
							actions={
								layer?.type?.length < 1 ? (
									icons.dummySpacer
								) : (
									<Button
										icon={hidden ? icons.dummySpacer : icons.visible}
										onPress={() => updateData({ hidden: !hidden })}
										tooltip={hidden ? __('Show', 'makewhatever') : __('Hide', 'makewhatever')}
										size='small'
									/>
								)
							}
							textValue={layerTypes?.[type]?.title ?? __('New layer', 'makewhatever')}
							expandDisabled={type === 'openStreetMap'}
						>
							{!type && (
								<Notice
									type='error'
									label={__('Error', 'makewhatever')}
									subtitle={__('Layer type is missing, please remove the layer and add a new one.', 'makewhatever')}
								/>
							)}

							{needsApiKey && (
								<InputField
									icon={icons.key}
									label={__('API key', 'makewhatever')}
									value={apiKey}
									onChange={(value) => updateData({ apiKey: value })}
								/>
							)}

							{hasMapStyleOptions && (
								<InputField
									icon={icons.color}
									label={__('Map style', 'makewhatever')}
									value={styleUrl}
									onChange={(value) => updateData({ styleUrl: value })}
									help={
										<>
											{!type?.startsWith('mapBox') &&
												__(
													'Copy the full style URL from MapTiler. Keep the API key inside the URL.',
													'makewhatever',
												)}
											{type === 'mapBoxVector' && __('Copy the full style URL from Mapbox.', 'makewhatever')}
											{type === 'mapBoxRaster' &&
												// eslint-disable-next-line max-len
												__(
													'Copy the full style URL from Mapbox or a Mapbox-compatible source. Keep the access token inside the URL.',
													'makewhatever',
												)}
											<br />
											<br />
											{['mapBoxRaster', 'mapTilerVector', 'mapTilerRasterXyz'].includes(type) && (
												<>
													<code className='es-bg-transparent es-p-0 es-text-3'>{'{z}/{x}/{y}'}</code>
													{
														// eslint-disable-next-line max-len
														__(
															"should be left as they are in the URL; they're needed for the map to work properly.",
															'makewhatever',
														)
													}
													<br />
													<br />
												</>
											)}
											{__('Example', 'makewhatever')}:
											<br />
											<span className='es-word-break-all'>
												{['mapTilerRasterJson', 'vectorJson'].includes(type) &&
													'https://api.maptiler.com/maps/{styleName}/tiles.json?key={apiKey}'}

												{type === 'mapTilerVector' && 'https://api.maptiler.com/tiles/v3/{z}/{x}/{y}.pbf?key={apiKey}'}

												{type === 'mapBoxVector' && (
													<>
														{'mapbox://styles/{styleName},'}
														<br />
														{'mapbox://styles/{userId}/{styleId}'}
													</>
												)}

												{type === 'mapBoxRaster' &&
													'https://api.mapbox.com/v4/{tilesetId}/{z}/{x}/{y}[@2x].{imageFormat}?acess_token={apiKey}'}

												{type === 'mapTilerRasterXyz' &&
													'https://api.maptiler.com/maps/{styleName}/{z}/{x}/{y}.png?key={apiKey}'}
											</span>
										</>
									}
								/>
							)}

							{type === 'geoJson' && (
								<FileSelector
									onChange={({ id, url }) => updateData({ geoJsonUrl: url, geoJsonId: id })}
									fileId={geoJsonId}
									fileName={geoJsonUrl?.slice(geoJsonUrl?.lastIndexOf('/') + 1)}
									allowedTypes={['application/geo+json', 'application/json']}
									kind='geoJson'
								/>
							)}
						</RepeaterItem>
					);
				}}
			</Repeater>
			<Spacer />

			<div>
				<Expandable
					label={__('Map display', 'makewhatever')}
					icon={icons.browser}
				>
					<Toggle
						icon={icons.tag}
						label={__('Attribution', 'makewhatever')}
						subtitle={__('Check map provider ToC', 'makewhatever')}
						checked={mapControls.attribution}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.attribution = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />

					<Toggle
						icon={icons.mapPin}
						label={__('Minimap', 'makewhatever')}
						checked={mapControls.overviewMap}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.overviewMap = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.ruler}
						label={__('Map scale', 'makewhatever')}
						checked={mapControls.scaleLine}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.scaleLine = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />

					<Toggle
						icon={icons.mouseCursor}
						label={__('Pointer position', 'makewhatever')}
						checked={mapControls.mousePosition}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.mousePosition = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />

					<Toggle
						icon={icons.expandXl}
						label={__('Full screen', 'makewhatever')}
						checked={mapControls.fullScreen}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.fullScreen = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.slider}
						label={__('Zoom slider', 'makewhatever')}
						checked={mapControls.zoomSlider}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.zoomSlider = value;
							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.plusMinusButtonsV}
						label={__('Zoom buttons', 'makewhatever')}
						checked={mapControls.zoom}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.zoom = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.roundedCorners}
						label={__('Zoom to extent', 'makewhatever')}
						checked={mapControls.zoomToExtent}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.zoomToExtent = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.rotateLeft}
						label={__('Reset rotation', 'makewhatever')}
						checked={mapControls.rotate}
						onChange={(value) => {
							const newValue = { ...mapControls };
							newValue.rotate = value;

							setAttributes({ [getAttrKey('mapControls', attributes, manifest)]: newValue });
						}}
					/>
				</Expandable>

				<Expandable
					label={__('Map interactions', 'makewhatever')}
					icon={icons.pointerHand}
				>
					<Toggle
						icon={icons.focus}
						label={__('Only when map is focused', 'makewhatever')}
						checked={mapInteractions.onFocusOnly}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.onFocusOnly = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />

					<Toggle
						icon={icons.keyboard}
						label={__('Keyboard interactions', 'makewhatever')}
						checked={mapInteractions.keyboard}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.keyboard = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						icon={icons.cursorMove}
						label={__('Drag to move map', 'makewhatever')}
						checked={mapInteractions.dragPan}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.dragPan = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />

					<Spacer
						icon={icons.rotateRight}
						text={__('Rotation', 'makewhatever')}
						border
					/>

					<Toggle
						label={__('Alt+Shift and drag to rotate', 'makewhatever')}
						checked={mapInteractions.altShiftDragRotate}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.altShiftDragRotate = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						label={__('Pinch to rotate', 'makewhatever')}
						checked={mapInteractions.pinchRotate}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.pinchRotate = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Spacer />
					<Spacer
						icon={icons.search}
						text={__('Zoom', 'makewhatever')}
						border
					/>

					<Toggle
						label={__('Double-click to zoom', 'makewhatever')}
						checked={mapInteractions.doubleClickZoom}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.doubleClickZoom = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						label={__('Zoom with mousewheel', 'makewhatever')}
						checked={mapInteractions.mouseWheelZoom}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.mouseWheelZoom = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						label={__('Shift and drag to zoom', 'makewhatever')}
						checked={mapInteractions.shiftDragZoom}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.shiftDragZoom = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<Toggle
						label={__('Pinch to zoom', 'makewhatever')}
						checked={mapInteractions.pinchZoom}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.pinchZoom = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
					/>

					<NumberPicker
						label={__('Transition duration', 'makewhatever')}
						value={mapInteractions.zoomDuration}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.zoomDuration = value;

							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
						min={0}
						max={10000}
						suffix='ms'
						inline
					/>

					<NumberPicker
						label={__('Zoom-in step', 'makewhatever')}
						value={mapInteractions.zoomDelta}
						onChange={(value) => {
							const newValue = { ...mapInteractions };
							newValue.zoomDelta = value;
							setAttributes({ [getAttrKey('mapInteractions', attributes, manifest)]: newValue });
						}}
						min={1}
						max={10}
						inline
					/>
				</Expandable>
			</div>

			<Spacer />
			<Spacer
				icon={icons.centerPoint}
				text={__('Start point', 'makewhatever')}
				border
			/>

			<HStack noWrap>
				<InputField
					label={__('Lat', 'makewhatever')}
					value={mapCenterLat}
					onChange={(value) => setAttributes({ [getAttrKey('mapCenterLat', attributes, manifest)]: value })}
					placeholder='46.314045'
				/>

				<InputField
					label={__('Lon', 'makewhatever')}
					value={mapCenterLon}
					onChange={(value) => setAttributes({ [getAttrKey('mapCenterLon', attributes, manifest)]: value })}
					placeholder='16.352532'
				/>

				<NumberPicker
					label={__('Zoom', 'makewhatever')}
					value={mapZoom}
					onChange={(value) => setAttributes({ [getAttrKey('mapZoom', attributes, manifest)]: value })}
					min={1}
					max={30}
					placeholder='14'
				/>
			</HStack>
		</>
	);
};

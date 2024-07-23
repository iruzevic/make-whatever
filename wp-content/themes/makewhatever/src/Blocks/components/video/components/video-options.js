import { __, sprintf } from '@wordpress/i18n';
import { getOption, checkAttr, getAttrKey, FileSelector, getHiddenOptions, MediaPicker } from '@eightshift/frontend-libs-tailwind/scripts';
import { AnimatedVisibility, BaseControl, Expandable, InputField, Notice, OptionSelect, Repeater, RepeaterItem, Spacer, Toggle } from '@eightshift/ui-components';
import { icons } from '@eightshift/ui-components/icons';
import manifest from '../manifest.json';

export const VideoOptions = (attributes) => {
	const { setAttributes, hideOptions } = attributes;

	const hiddenOptions = getHiddenOptions(hideOptions);

	const videoUrl = checkAttr('videoUrl', attributes, manifest, true);
	const videoId = checkAttr('videoId', attributes, manifest, true);
	const videoPosterId = checkAttr('videoPosterId', attributes, manifest);
	const videoPosterUrl = checkAttr('videoPosterUrl', attributes, manifest);
	const videoLoop = checkAttr('videoLoop', attributes, manifest);
	const videoAutoplay = checkAttr('videoAutoplay', attributes, manifest);
	const videoControls = checkAttr('videoControls', attributes, manifest);
	const videoMuted = checkAttr('videoMuted', attributes, manifest);
	const videoPreload = checkAttr('videoPreload', attributes, manifest);
	const videoSubtitleTracks = checkAttr('videoSubtitleTracks', attributes, manifest);

	const getTrackIcon = (kind) => {
		switch (kind) {
			case 'subtitles':
				return icons.videoSubtitle;
			case 'captions':
				return icons.closedCaptions;
			case 'descriptions':
				return icons.hide;
			case 'chapters':
				return icons.videoChapters;
		}

		return icons.emptyRect;
	};

	return (
		<>
			<AnimatedVisibility
				visible={videoPosterId && !videoControls}
				noInitial
			>
				<Notice
					type='warning'
					label={__('Playback controls disabled', 'makewhatever')}
					subtitle={__('Poster image might prevent users from playing the video', 'makewhatever')}
				/>
			</AnimatedVisibility>

			<FileSelector
				onChange={({ id, url, mime, mime_type }) =>
					setAttributes({
						[getAttrKey('videoId', attributes, manifest)]: id,
						[getAttrKey('videoUrl', attributes, manifest)]: url,
						[getAttrKey('videoMimeType', attributes, manifest)]: typeof mime === 'undefined' ? mime_type : mime,
					})
				}
				fileId={videoId}
				fileName={videoUrl?.slice(videoUrl?.lastIndexOf('/') + 1)}
				allowedTypes={['video/mp4', 'video/webm']}
				kind='video'
			/>

			<Spacer />

			<Spacer
				icon={icons.playbackOptions}
				text={__('Playback', 'makewhatever')}
				border
			/>

			<Toggle
				icon={icons.videoControls}
				label={__('Video controls', 'makewhatever')}
				checked={videoControls}
				onChange={(value) => setAttributes({ [getAttrKey('videoControls', attributes, manifest)]: value })}
				hidden={hiddenOptions?.playbackControls}
			/>

			<Toggle
				icon={icons.loopMode}
				label={__('Loop', 'makewhatever')}
				checked={videoLoop}
				onChange={(value) => setAttributes({ [getAttrKey('videoLoop', attributes, manifest)]: value })}
				hidden={hiddenOptions?.loop}
			/>

			<Toggle
				icon={icons.autoplayAlt}
				label={__('Autoplay', 'makewhatever')}
				checked={videoAutoplay}
				onChange={(value) => setAttributes({ [getAttrKey('videoAutoplay', attributes, manifest)]: value })}
				hidden={hiddenOptions?.autoplay}
			/>

			<Toggle
				icon={icons.muteCentered}
				label={__('Mute', 'makewhatever')}
				checked={videoMuted}
				onChange={(value) => setAttributes({ [getAttrKey('videoMuted', attributes, manifest)]: value })}
				hidden={hiddenOptions?.mute}
			/>

			<AnimatedVisibility
				visible={videoAutoplay && !videoMuted && !videoControls}
				noInitial
			>
				<Notice
					type='warning'
					label={__('Video plays automatically, with sound, and without controls', 'makewhatever')}
					subtitle={__('This will bother most users and is an accessibility issue. Consider changing some of the options.', 'makewhatever')}
					icon={icons.a11yWarning}
					alignIconToTitle
				/>
			</AnimatedVisibility>

			<Spacer />

			<Spacer
				icon={icons.a11y}
				text={__('Accessibility', 'makewhatever')}
				border
			/>

			<Repeater
				icon={icons.videoSubtitleAlt}
				label={__('Captions', 'makewhatever')}
				items={videoSubtitleTracks}
				onChange={(value) => setAttributes({ [getAttrKey('videoSubtitleTracks', attributes, manifest)]: value })}
			>
				{(item) => {
					const { trackId, trackFileName, kind, srclang, label, updateData, itemIndex: index } = item;

					return (
						<RepeaterItem
							icon={getTrackIcon(kind)}
							label={label ? sprintf(__('Track %d', 'makewhatever'), index + 1) : __('New track', 'makewhatever')}
							subtitle={label}
						>
							<FileSelector
								onChange={({ id, url }) =>
									updateData({
										trackId: id,
										trackFileName: url,
									})
								}
								fileId={trackId}
								fileName={trackFileName?.slice(trackFileName?.lastIndexOf('/') + 1)}
								allowedTypes={['text/vtt']}
								kind='subtitle'
							>
								{__('Upload a VTT file containing captions, subtitles, descriptions or chapters', 'makewhatever')}
							</FileSelector>

							<Spacer />

							<OptionSelect
								icon={icons.optionListAlt}
								label={__('Type', 'makewhatever')}
								value={kind}
								options={getOption('videoSubtitleTrackKind', attributes, manifest)}
								onChange={(value) => updateData({ kind: value })}
								vertical
							/>

							<Spacer />

							<InputField
								icon={icons.titleGeneric}
								label={__('Label', 'makewhatever')}
								help={__('Shows in the list of available tracks', 'makewhatever')}
								value={label}
								onChange={(value) => updateData({ label: value })}
							/>

							<InputField
								icon={icons.flag}
								label={__('Language code', 'makewhatever')}
								help={
									<>
										{__('Should follow IETF (BCP47).', 'makewhatever')}
										{kind === 'subtitles' && ' ' + __('Required.', 'makewhatever')}
									</>
								}
								value={srclang}
								onChange={(value) => updateData({ srclang: value })}
							/>

							<Spacer />

							<div className='es-uic-space-y-1'>
								<Spacer text={__('List of language tags', 'makewhatever')} />

								<a
									href='https://en.wikipedia.org/wiki/IETF_language_tag#List_of_major_primary_language_subtags'
									target='_blank'
									rel='external'
									className='es-uic-flex es-uic-items-center es-uic-gap-1.5 es-uic-text-sm [&>svg]:es-uic-size-4 [&>svg]:es-uic-stroke-[1.5]'
								>
									{__('Common languages', 'makewhatever')}
									{icons.externalLink}
								</a>

								<a
									href='https://r12a.github.io/app-subtags/'
									target='_blank'
									rel='external'
									className='es-uic-flex es-uic-items-center es-uic-gap-1.5 es-uic-text-sm [&>svg]:es-uic-size-4 [&>svg]:es-uic-stroke-[1.5]'
								>
									{__('All languages', 'makewhatever')}
									{icons.externalLink}
								</a>
							</div>
						</RepeaterItem>
					);
				}}
			</Repeater>

			<Spacer />

			<Expandable
				icon={icons.moreHCircle}
				label={__('Advanced', 'makewhatever')}
			>
				<BaseControl
					icon={icons.videoPosterImage}
					label={__('Poster image', 'makewhatever')}
					subtitle={__('Visible before the video is played', 'makewhatever')}
					hidden={hiddenOptions?.posterImage}
				>
					<MediaPicker
						onChange={({ id, url }) =>
							setAttributes({
								[getAttrKey('videoPosterId', attributes, manifest)]: id,
								[getAttrKey('videoPosterUrl', attributes, manifest)]: url,
							})
						}
						imageId={videoPosterId}
						imageUrl={videoPosterUrl}
					/>
				</BaseControl>

				<Spacer />

				<OptionSelect
					icon={icons.preload}
					label={__('Preload', 'makewhatever')}
					value={videoPreload}
					options={getOption('videoPreload', attributes, manifest)}
					alignment='vertical'
					onChange={(value) => setAttributes({ [getAttrKey('videoPreload', attributes, manifest)]: value })}
					hidden={hiddenOptions?.preload}
				/>
			</Expandable>
		</>
	);
};

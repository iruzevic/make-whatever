const defaultTheme = require('tailwindcss/defaultTheme');
import { processEightshiftClasses, getScreens } from '@eightshift/frontend-libs-tailwind/scripts/editor/tailwindcss';
import globalManifest from './src/Blocks/manifest.json';
import fluid, { extract } from 'fluid-tailwind';
import plugin from 'tailwindcss/plugin';
import animate from 'tailwindcss-animate';
import { themeColors } from './assets/scripts/theme-colors';

/** @type {import('tailwindcss').Config} */
export default {
	content: {
		files: ['./src/**/*.{html,js,php,json}', './**/*.php'],
		transform: processEightshiftClasses(Object.keys(globalManifest.globalVariables.breakpoints)),
		extract,
	},
	theme: {
		colors: themeColors,
		screens: getScreens(globalManifest.globalVariables.breakpoints),
		extend: {
			fontFamily: {
				sans: ['Inter', 'sans-serif'],
				display: ['Inter Display', 'sans-serif'],
			},
			fontSize: {
				'xs': '0.7rem',
				'sm': '0.75rem',
				'tiny': '0.85rem',
				'md': '0.875rem',
				'base': '1rem',
				'lg': '1.125rem',
				'xl': '1.14rem',
				'2xl': '1.145rem',
				'3xl': '1.4rem',
				'4xl': '1.45rem',
				'5xl': '1.5rem',
				'6xl': '1.7rem',
				'7xl': '2rem',
				'8xl': '2.5rem',
				'9xl': '2.75rem',
				'10xl': '3.45rem',
				'11xl': '4rem',
				'12xl': '5rem',
				'13xl': '6rem',
			},
			gridColumnEnd: {
				'span-1': 'span 1',
				'span-2': 'span 2',
				'span-3': 'span 3',
				'span-4': 'span 4',
				'span-5': 'span 5',
				'span-6': 'span 6',
				'span-7': 'span 7',
				'span-8': 'span 8',
				'span-9': 'span 9',
				'span-10': 'span 10',
				'span-11': 'span 11',
				'span-12': 'span 12',
			},
			gridRowEnd: {
				'span-1': 'span 1',
				'span-2': 'span 2',
				'span-3': 'span 3',
				'span-4': 'span 4',
				'span-5': 'span 5',
				'span-6': 'span 6',
				'span-7': 'span 7',
				'span-8': 'span 8',
				'span-9': 'span 9',
				'span-10': 'span 10',
				'span-11': 'span 11',
				'span-12': 'span 12',
			},
			rotate: {
				135: '135deg',
			},
			aspectRatio: {
				'3/2': '3 / 2',
				'5/4': '5 / 4',
				'21/9': '21 / 9',
			},
		},
	},
	plugins: [
		fluid(),
		animate,
		plugin(({ addComponents, addVariant }) => {
			addComponents({
				'.font-synthesis-none': {
					'font-synthesis': 'none',
				},
				'.font-synthesis': {
					'font-synthesis': 'auto',
				},
			});
			addVariant('open', '&.is-open');
			addVariant('wp-logged-in', 'body.logged-in &');
			addVariant('wp-logged-in-mobile', '@media (max-width: 782px) { body.logged-in & }');
		}),
	],
};

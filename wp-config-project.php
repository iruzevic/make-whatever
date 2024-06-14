<?php

/**
 * Global Environment variable
 *
 * Define global environment variable, and define certain
 * settings based on it.
 *
 * @package Makewhatever
 */

// phpcs:disable
if (!\defined('WP_ENVIRONMENT_TYPE')) {
	return false;
}

// Setting salts.
// You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
if (!defined('AUTH_KEY')) {
	define('AUTH_KEY', 'Od)gxz~(4}Gb.|Sw|;B++}GPOgghZ+A;r#%kEx~.Ts` pAjzRU]aKQRKT77:y~a*');
}
if (!defined('SECURE_AUTH_KEY')) {
	define('SECURE_AUTH_KEY', ' *[LBU,Pz.<0ZmVXm%^b_C<2a_+e0E,}x:U!{]O$v3k212KBP|}AL?X]%/^>{/F3');
}
if (!defined('LOGGED_IN_KEY')) {
	define('LOGGED_IN_KEY', '^-oZGoj*SF#8H @]aEu^l7?&W`}w(*&eMrY/EtF.I6]&N52e1NO1G]7`3n8 U<[+');
}
if (!defined('NONCE_KEY')) {
	define('NONCE_KEY', 'E*cC8FGj3gXlOJK|BliDwWe<nCoJG$Jg>hPqy<sm+e|.Cj~wl=L-1}4{IZFFWi?<');
}
if (!defined('AUTH_SALT')) {
	define('AUTH_SALT', ')lsi?9]@0;}yBdO#i `Za2PT[i($Q0z,c|2wLEc*79dQ6#0:r.;7iJEf~E.aj12:');
}
if (!defined('SECURE_AUTH_SALT')) {
	define('SECURE_AUTH_SALT', 'd6TV_%+PSeQi2W3IP6)Tu/nDZbIBozt#nx,%nG3Zn.G}}PxU`bAg.NFNN}~zKZ8H');
}
if (!defined('LOGGED_IN_SALT')) {
	define('LOGGED_IN_SALT', '.^Z^lD>0U.KmS`9V6a(>qjhNN]x[B?!w%C$0qd49b%Ok^|%3IZ>gk_z/0E>eW!B9');
}
if (!defined('NONCE_SALT')) {
	define('NONCE_SALT', 'rM7AZ/Y^Lk-9]Yw={6)qMHuCq<CX$R&!3z7Gl_*(.*J}1EvCKHtS1>tS[LVl+AO;');
}
if (!defined('WP_CACHE_KEY_SALT')) {
	define('WP_CACHE_KEY_SALT', 'yu)%A}1n]2}u~:W-_ao2/l$jS6n]@ZAy(I_r&XRYBZyCbv}D0{r/pz4hgzHiHb)t');
}

// Limit revisions for better optimizations.
define('WP_POST_REVISIONS', 10);

// Optimize assets in admin.
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);
define('CONCATENATE_SCRIPTS', true);
define('ENFORCE_GZIP', true);

// Disable editing theme from admin.
define('DISALLOW_FILE_EDIT', true);

// Auto save interval higher to optimize admin.
define('AUTOSAVE_INTERVAL', 240);

// Disable automatic updating of plugins.
define('AUTOMATIC_UPDATER_DISABLED', true);

if (\WP_ENVIRONMENT_TYPE !== 'production') {
	// Enable debug and error logging.
	define('WP_DEBUG', true);
	define('WP_DEBUG_LOG', true);
}

// Environment based setup.
if (\WP_ENVIRONMENT_TYPE === 'development' || \WP_ENVIRONMENT_TYPE === 'local') {
	// Enable direct upload from admin.
	define('FS_METHOD', 'direct');

	// Enable debug and error logging.
	define('WP_DEBUG_DISPLAY', true);
} else {
	// Disable plugins / themes updates from admin.
	define('DISALLOW_FILE_MODS', true);

	// Force login to admin with ssl.
	define('FORCE_SSL_LOGIN', true);

	// Enable debug and error logging.
	define('WP_DEBUG_DISPLAY', false);
}

// phpcs:enable

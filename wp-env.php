<?php
$env_file = ABSPATH . '.env';

if ( !file_exists ( $env_file ) ) {
    define( 'WPINC', 'wp-includes' );
    require_once( ABSPATH . WPINC . '/load.php' );

    // Standardize $_SERVER variables across setups.
    wp_fix_server_vars();

    require_once( ABSPATH . WPINC . '/functions.php' );

    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
    require_once( ABSPATH . WPINC . '/version.php' );

    wp_check_php_mysql_versions();
    wp_load_translations_early();

    // Die with an error message
    $die  = sprintf(
        /* translators: %s: wp-config.php */
        __( "There doesn't seem to be a %s file. I need this before we can get started." ),
        '<code>.env</code>'
    ) . '</p>';

    wp_die( $die, __( 'WordPress &rsaquo; Error' ) );

}

$contents = file_get_contents( $env_file );
$variables = explode( PHP_EOL, $contents );
$variables = array_diff($variables, [""]);

foreach ( $variables as $variable) {
    putenv( $variable );
}

function env ( $key, $default = false ) {
    return getenv( strtoupper( $key ) ) ?? $default;
}

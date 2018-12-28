<?php
$env_file = ABSPATH . '.env';

if ( file_exists ( $env_file ) ) {
    $contents = file_get_contents( $env_file );
    $variables = explode( PHP_EOL, $contents );
    $variables = array_diff($variables, [""]);

    foreach ( $variables as $variable) {
        putenv( $variable );
    }
}

function env ( $key, $default = false ) {
    return getenv( strtoupper( $key ) ) ?? $default;
}

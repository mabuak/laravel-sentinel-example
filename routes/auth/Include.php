<?php
/**
 * Created by PhpStorm.
 * User: DhanPris
 * Date: 04/05/2018
 * Time: 19:56
 */

#To Find Another Routes Files
$dir   = base_path( 'routes/auth' );
$files = scandir( $dir );

foreach ( $files as $file ) {
    if ( ! in_array( $file, array( '.', '..', 'Include.php' ) ) ) {
        require $dir . '/' . $file;
    }
};
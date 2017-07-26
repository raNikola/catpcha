<?php
session_start();
$text = create_string( mt_rand( 5, 7 ) );

/* Use time to generate captcha */
// $text               = substr( md5( microtime() ), mt_rand( 0, 26 ), mt_rand( 5, 7 ) );

$_SESSION["ttcapt"] = $text;
$height             = 35;
$width              = 135;
$tt_image           = imagecreate( $width, $height );

/* dark version */
//$black              = imagecolorallocate( $tt_image, 0, 0, 0 );
/* Lite version */
$black = imagecolorallocate( $tt_image, 255, 255, 255 );

$lcolor = ImageColorAllocate( $tt_image, mt_rand( 110, 210 ), mt_rand( 120, 210 ), mt_rand( 130, 210 ) );

// Create line vertices
$vertices = array();
for ( $i = 0; $i < 30; $i ++ ) {
	if ( $i % 2 != 0 ) {
		$vertices[ $i ] = mt_rand( 0, 60 );
	} else {
		$vertices[ $i ] = mt_rand( 0, 150 );
	}
}

// imagepolygon ( resource $image , array $points , int $num_points , int $color )
imagepolygon( $tt_image, $vertices, 10, $lcolor );

$ttfont    = "./fonts/ZillaSlab-Regular.ttf";
$font_size = ( strlen( $text ) < 6 ) ? mt_rand( 19, 21 ) : mt_rand( 16, 18 );
$x         = mt_rand( 5, 10 );
$y         = mt_rand( 22, 28 );
$fangle    = mt_rand( - 7, 6 );

/* Dark Version */
//$fcolor    = ImageColorAllocate( $tt_image, mt_rand( 200, 255 ), mt_rand( 240, 250 ), mt_rand( 210, 255 ) );
/* Lite version */
$fcolor = ImageColorAllocate( $tt_image, mt_rand( 0, 55 ), mt_rand( 40, 50 ), mt_rand( 10, 55 ) );

// imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
imagettftext( $tt_image, $font_size, $fangle, $x, $y, $fcolor, $ttfont, $text );

/* Avoid Caching */
header( "Expires:" . gmdate( 'D, d M Y H:i:s \G\M\T', time() + ( 60 * 60 ) ) );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
header( "Content-type: image/png" );
imagepng( $tt_image );
imagedestroy( $tt_image );


/*
 * hex Numbers [0-9] .: &#48 - &#57 :.
 * hex Uppercase letters [a-z] .: &#65 - &#90 :.
 * hex Lowercase letters [A-Z] .: &#97 - &#122 :.
 */

function create_string( $way ) {
	$word = '';
	// Check word length
	while ( strlen( $word ) < $way ) {
		// Get random number and convert hex
		$char = html_entity_decode( '&#' . mt_rand( 48, 122 ) . ';' );
		// Check if alphanumeric
		if ( preg_match( '/^[a-zA-Z0-9]/', $char ) ) {
			$word .= $char;
		}
	}

	return $word;
}

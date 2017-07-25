<?php
session_start();
$text               = substr( md5( microtime() ), mt_rand( 0, 26 ), mt_rand( 5, 7 ) );
$_SESSION["ttcapt"] = $text;
$height             = 35;
$width              = 110;
$tt_image           = imagecreate( $width, $height );
$black              = imagecolorallocate( $tt_image, 0, 0, 0 );
$lcolor             = ImageColorAllocate( $tt_image, mt_rand( 110, 210 ), mt_rand( 120, 210 ), mt_rand( 130, 210 ) );
$vertices           = array();

// Create line vertices
for ( $i = 0; $i < 100; $i ++ ) {
	if ( $i % 2 != 0)
		$vertices[ $i ] = mt_rand( 0, 60 );
	else
		$vertices[ $i ] = mt_rand( 0, 150 );
}

// imagepolygon ( resource $image , array $points , int $num_points , int $color )
imagepolygon( $tt_image, $vertices, 15, $lcolor );

$ttfont    = "./fonts/ZillaSlab-Regular.ttf";
$font_size = mt_rand( 20, 21 );
$x         = mt_rand( 2, 6 );
$y         = mt_rand( 22, 28 );
$fangle    = mt_rand( - 7, 6 );
$fcolor    = ImageColorAllocate( $tt_image, mt_rand( 200, 255 ), mt_rand( 240, 250 ), mt_rand( 210, 255 ) );

// imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
imagettftext( $tt_image, $font_size, $fangle, $x, $y, $fcolor, $ttfont, $text );

/* Avoid Caching */
header( "Expires:" .gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
header( "Content-type: image/png" );
imagepng( $tt_image );
imagedestroy( $tt_image );
?>

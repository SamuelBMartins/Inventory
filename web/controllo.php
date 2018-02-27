<!DOCTYPE html>
<?php
include_once dirname( __FILE__ ) . '/includes/classi.inc.php';
IO::start();
?>
<html>

<?php IO::head(); ?>

<body>
	<?php
	$key = IO::key();

	$db = new DB();
	$idcons = $db->contr_scan( $key );
	if ( empty( $idcons ) ) {
		header( "location: $root/registrazione.php" );
		exit();
	}

	if ( !isset( $_GET[ 'id' ] ) ){
		IO::error( 'Nessun dispositivo dichiarato', false );
		IO::menu(10);
		exit();
	}


	$row = $db->r_1disp( $_GET[ 'id' ] );

	if ( $row[ 'smaltito' ] == 0 ) {
		$db->agg_contr( $row[ 'idDispositivi' ], $idcons );
		IO::success( 'Ultimo controllo aggiornato' );
		IO::menu(10);
	}

	$id = $row[ 'idDispositivi' ];
	include $_SERVER[ 'DOCUMENT_ROOT' ] . $root . '/informazioni.php';
	?>
<!DOCTYPE html>
<?php
include_once dirname( __FILE__ ) . '/includes/classi.inc.php';
IO::start();

if ( isset( $_SESSION[ 'password' ] )AND $_SESSION[ 'data' ] == date( 'Y-m-d' ) ) { //se loggato...
	header( "location: $root/private/consenti.php" );
	exit();
}
?>

<html>

<?php IO::head(); ?>

<body>

	<?php
	if ( isset( $_POST[ 'password' ] ) ) {

		function log_accessi( $passcoe ) {//salva in un file tutti i tentativi
			$data = date( "d-m-Y G:i:s" );

			$fp = fopen( $_SERVER[ 'DOCUMENT_ROOT' ] . $GLOBALS[ 'root' ] . '/log/accessi.log', 'a' );
			fwrite( $fp, 'password ' . $passcoe . ' | password: ' . $_POST[ 'password' ] . ' | IP: ' . $_SERVER[ 'REMOTE_ADDR' ] . ' | data: ' . $data . PHP_EOL );
			fclose( $fp );
		}

		$db = new DB();
		$pass = $db->password();
		$hash = $pass[ 'password' ];

		if ( password_verify( $_POST[ 'password' ], $hash ) ) { //se password corretta
			$_SESSION[ 'password' ] = $_POST[ 'password' ];
			$_SESSION[ 'data' ] = date( "Y-m-d" ); //accesso dura 1 giorno

			$db->accessi( $pass[ 'idAccesso' ] );

			log_accessi( 'corretta' ); //inserisce nel log tentativo
			header( "location: $root/private/consenti.php" );
			exit();
		} else {
			log_accessi( 'errata' );
			$error = 'Password errata.';
			IO::error( $error, false );
		}
	}
	?>
	<br>
	<div class="login">
		<form action="" method="post">
			<p>Inserisci password:</p>
			<input type="password" name="password"><br>
			<input class="tasto_invia" type="submit" value="Accedi">
		</form>
	</div>
</body>

</html>
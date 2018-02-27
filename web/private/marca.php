<!DOCTYPE html>
<?php 
include_once dirname(__FILE__) . '/../includes/classi.inc.php';
IO::start();
IO::check();
?>
<html>

<?php IO::head(); ?>

<body>
	<?php
	if ( isset( $_POST[ 'marca' ] ) ) {

		include $_SERVER[ 'DOCUMENT_ROOT' ] . $root . '/includes/db.inc.php';

		try {
			$sql = 'INSERT INTO marca(`marca`)
					VALUES (:marca)';
			$result = $pdo->prepare( $sql );
			$result->bindValue( ':marca', $_POST[ 'marca' ] );
			$result->execute();
		} catch ( PDOException $e ) {
			$error = 'Errore richiesta dispositivo database.';
			include $_SERVER[ 'DOCUMENT_ROOT' ] . $root . '/includes/error.inc.php';
			exit();
		}
		IO::success( 'Marca aggiunto.' );
	}
	IO::menu( 2 );
	?>
	<div class="login">
		<form action="" method="post">

			<p>Marca:</p>
			<input type="text" name="marca"><br>
			<input type="submit" value="Aggiungi">
		</form>
	</div>
</body>

</html>
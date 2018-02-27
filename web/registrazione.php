<!DOCTYPE html>
<?php
include_once dirname( __FILE__ ) . '/includes/classi.inc.php';
IO::start();
?>
<html>

<?php IO::head(); ?>

<body>

	<?php

	if ( !isset( $_POST[ 'nome' ] ) ) {
		IO::menu( 10 );
		?>
	<br>
	<div class="login">
		<form action="" method="post">
			<div class="richiedi_accesso">Richiedi accesso</div>
			<br>Nome:<br>
			<input type="text" name="nome"><br>
			<div class="box">Cognome:<br>
			</div>
			<input type="text" name="cognome"><br>
			<input class="tasto_invia" type="submit" value="Invia">
		</form>
	</div>

	<?php
	} else {
		$key = IO::key();
		$nome = $_POST[ 'nome' ] . '.' . $_POST[ 'cognome' ];

		$db = new DB();
		$db->i_rscan( $nome, $key );
		echo '<div class="bar-verde">Richiesta inviata</div>';
		IO::menu( 10 );
	}
	?>
</body>

</html>
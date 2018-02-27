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
	IO::menu( 3 );
	if ( isset( $_GET[ 'ricerca' ] ) ) {
		$ricerca = IO::camp_ricerca( $_GET[ 'ricerca' ] );

		$table = new table();
		$result = $table->ricerca( $ricerca );
		$sql = $table->getsql4count();
		$table->nrow( $sql );

		$fields = array( 'Serial Number',
			'Product Name',
			'Etichetta',
			'Aula',
			'Marca',
			'Tipo' );
		$table->header( $fields );
		$dati = array( 'serial_number',
			'product_name',
			'etichetta',
			'aula',
			'marca',
			'tipo' );
		$table->setdati( $dati );
		$sql = $table->getsql();
		$table->query( $sql );
		$table->popola_disp();
		$table->end();
	}else{

		?>
	<br>
	<div class="login">
		<form action="" method="get">
			<p>Cerca:</p>
			<input type="text" name="ricerca"><br>
			<input class="tasto_invia" type="submit" value="Cerca">
		</form>
		<span class="link_qr"><a href="ricerca_avanzata.php">Ricerca avanzata</a></span>
	</div>
	<?php }?>
</body>

</html>
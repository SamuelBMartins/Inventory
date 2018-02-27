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

	if ( isset( $_GET[ 'aula' ] ) ) {
		$table = new table();
		$result = $table->ricerca_av( $_GET[ 'serial_number' ], $_GET[ 'product_name' ], $_GET[ 'product_number' ], $_GET[ 'inizio_garanzia' ], $_GET[ 'fine_garanzia' ], $_GET[ 'etichetta' ], $_GET[ 'note' ], $_GET[ 'smaltito' ], $_GET[ 'aula' ], $_GET[ 'marca' ], $_GET[ 'tipo' ], $_GET[ 'macaddress' ] );

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


	} else {
		?>
	<br>
	<form action="" method="get">

		<div class="sinistra_agg">Serial number:</div>
		<input type="text" name="serial_number"><br>

		<div class="sinistra_agg">Product name</div>
		<input type="text" name="product_name"><br>

		<div class="sinistra_agg">product number</div>
		<input type="text" name="product_number"><br>

		<div class="sinistra_agg">inizio garanzia</div>
		<input type="text" name="inizio_garanzia" value="es. 20-03-2017"><br>

		<div class="sinistra_agg">fine garanzia</div>
		<input type="text" name="fine_garanzia" value="es. 20-03-2017"><br>

		<div class="sinistra_agg">etichetta</div>
		<input type="text" name="etichetta"><br>

		<div class="sinistra_agg">Smaltito:</div>
		<input type="text" name="smaltito"><br>

		<div class="sinistra_agg">Note:</div>
		<input type="text" name="note"><br>

		<div class="sinistra_agg">Aula</div>
		<select name="aula">
			<option value="%">Tutti</option>
			<?php IO::m_tend('aula'); ?>
		</select>
		<br>
		<div class="sinistra_agg">Marca</div>
		<select name="marca">
			<option value="%">Tutti</option>
			<?php IO::m_tend('marca'); ?>
		</select>
		<br>
		<div class="sinistra_agg">Tipo:</div>
		<select name="tipo">
			<option value="%">Tutti</option>
			<?php IO::m_tend('tipo'); ?>
		</select>
		<br>
		<div class="sinistra_agg">MAC address:</div>
		<input type="text" name="macaddress"><br>

		<div class="sinistra_agg"><input class="tasto_invia" type="submit" value="Cerca">
		</div>
	</form>
	<?php }?>
</body>

</html>
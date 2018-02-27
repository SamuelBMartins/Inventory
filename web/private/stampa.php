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
	IO::menu( 1 );
	$db = new DB();
	$result = $db->r_disp();

	for ( $i = 1; $i <= $result->rowCount(); $i++ ) { //mostra 1 a 1 dispositivi
		$row = $result->fetch();

		echo '<div class="disp"><div class="qr">';

		QR::online( $row[ 'idDispositivi' ], '120' );
		echo PHP_EOL;
		QR::offline( $row, '150' );

		?>
	</div>
	<div class="info">
		<p>
			<?php
			$campi = array( 'serial_number',
				'product_name',
				'etichetta',
				'aula',
				'marca',
				'tipo' );

			$nomi = array( 'Serial number',
				'Product name',
				'Etichetta',
				'Aula',
				'Marca',
				'Tipo' );
			for ( $a = 0; $a < count( $campi ); $a++ ) //mostra info dei campi presenti nei array precedenti
				echo $nomi[ $a ] . ': ' . $row[ $campi[ $a ] ] . PHP_EOL;
			?>
		</p>
	</div>
	</div>


	<?php
	if ( ( $i % 2 ) == 0 ) //ogni 2 dispositivi va a capo
		echo '<div class="clear"></div>';
	} //fine for


	?>
</body>

</html>
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
	IO::menu( 0 );
	$data = date( "Y-m-d", strtotime( '-2 day' ) );

	$table = new table();
	$table->controllo( $data );
	$sql = $table->getsql();
	$sql4count = $table->getsql4count();

	$table->nrow( $sql4count );

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
	$table->query( $sql );
	$table->popola_disp();
	$table->end();
	?>

	</body>

</html>
<?php
$campi = array( 'serial_number',
	'product_name',
	'product_number',
	'inizio_garanzia',
	'fine_garanzia',
	'etichetta',
	'note',
	'smaltito',
	'aula',
	'marca',
	'tipo' );

$nomi = array( 'Serial number',
	'Product name',
	'Product number',
	'Inizio garanzia',
	'Fine garanzia',
	'Etichetta',
	'Note',
	'Smaltito',
	'Aula',
	'Marca',
	'Tipo' );

echo '<br>';
for ( $i = 0; $i < count( $campi ); $i++ ) {
	if ( $campi[ $i ] == 'smaltito' ) {
		$x = 1;
		echo '<div class="sinistra_agg">stato</div>';
		if ( $row[ $campi[ $i ] ] == 0 ) {
			echo 'Non smaltito';
		} else {
			echo 'Smaltito';
		}
		echo '<br>';
	}

	if ( !isset( $x ) ) {
		echo '<div class="sinistra_agg">' . $nomi[ $i ] . '</div>
        ' . $row[ $campi[ $i ] ] . '<br>';
	}
}

if ( isset( $row[ 'macadress' ] ) ) {
	$macaddress = $db->r_mac( $row[ 'idDispositivi' ] );
}
foreach ( $macaddress as $mac ) {
	echo '<div class="sinistra_agg">MAC address: </div><div class="sinistra_agg">
        ' . $mac[ 0 ] . '</div><div class="sinistra_agg">Note: </div><div class="sinistra_agg">' . $mac[ 1 ] . '</div><br>';
}
?>